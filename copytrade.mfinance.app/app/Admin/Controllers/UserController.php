<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\AddToCopierSubscriptionAction;
use App\Admin\Extensions\Tools\AddToCopierSubscriptionGridExt;
use App\Admin\Extensions\Tools\AddToEmailSubscriptionAction;
use App\Admin\Extensions\Tools\AddToEmailSubscriptionGridExt;
use App\Mail\WelcomeMail;

use App\ManagerMailer;
use App\Models\CopierSubscription;
use App\Models\EmailSubscription;
use App\Models\UserCopierSubscription;
use App\Models\UserEmailSubscription;
use App\User;
use Encore\Admin\Controllers\AdminController;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;

use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends AdminController
{
    public function clientArea() {
        return redirect('https://profitmama.com/account', 302);
    }

    private $openPassword;

    protected function title() {
        return trans('admin.my_users');
    }

    public function impersonate(Request $request, $id)
    {
        if ($id == Admin::user()->id) {
            return redirect('/');
        }

        app('impersonate')->login(User::find($id));

        return response('', 302);
    }

    public function deimpersonate(Request $request)
    {
        if (!app('impersonate')->isActive()) {
            if ($request->has('redirect_to')) {
                return response('', 302, ['Location' => $request->get('redirect_to')]);
            }
            redirect('/');
        }

        app('impersonate')->logout();
//        if ($request->has('redirect_to')) {
//            return response('', 302, ['Location' => $request->get('redirect_to')]);
//        }

        return response('', 302);
    }

    protected function details($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->id('ID');
        $show->name('Name');
        $show->email('Email');
        $show->activated('Actvated?')->as(function ($val) {
            return $val == 1 ? 'Yes' : 'No';
        });
        $show->api_token('API Token');
        $show->created_at('Created');
        $show->updated_at('Updated');

        $show->accounts('Accounts', function ($account) {
            $account->resource('/admin/accounts');

            $account->account_number('Account');
            $account->name('Name');
            $account->broker_server()->name('Broker');
            $account->created_at('Created');
            $account->updated_at('Created');
        });

        return $show;
    }

    protected function grid()
    {
        return new Grid(new User(), function (Grid $grid) {
            $grid->model()->where('manager_id', User::GetManagerId());

            $grid->id('ID');
            $grid->email('Email');
            $grid->username('Login');
            $grid->name('Name');
            //$grid->activated('Active')->switch()->sortable();

            $grid->column('subscriptionsettings.max_accounts', 'Max Accounts' );
            $grid->column('_accounts','Accounts')->help('Total added accounts/Maximum allowed accounts');
            $grid->column('accounts','Accounts')->display(function ($account) {
                 return count($account);
            });

            if (Admin::user()->can('mng.copiers')) {
                $grid->copiersubscriptions('Copier Subscriptions')->pluck('title')->label();
            }
            if (Admin::user()->can('mng.user_email_subscriptions')) {
                $grid->emailsubscriptions('Email Subscriptions')->pluck('title')->label();
            }

            if (Admin::user()->can('mng.user_expert_subscriptions')) {
                $grid->expertsubscriptions('Expert Subscriptions')->pluck('title')->label();
            }

            if(!Admin::user()->isRole('assistant'))
                $grid->column('impersonate', 'Impersonate');
            $grid->created_at()->sortable();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('email');
                //$filter->like('username');
                $filter->like('name');
                $filter->disableIdFilter();
            });

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();

                if (Admin::user()->can('mng.copiers')) {
                    $t = new AddToCopierSubscriptionGridExt();
                    foreach (CopierSubscription::whereManagerId(User::GetManagerId())->get() as $subscription) {
                        $t->add(new AddToCopierSubscriptionAction($subscription->id, $subscription->title));
                    }

                    $tools->append($t);
                }

                if (Admin::user()->can('mng.user_email_subscriptions')) {
                    $t = new AddToEmailSubscriptionGridExt();
                    foreach (EmailSubscription::whereManagerId(User::GetManagerId())->get() as $item) {
                        $t->add(new AddToEmailSubscriptionAction($item->id, $item->title));
                    }

                    $tools->append($t);
                }
            });
            //$grid->setActionClass(Grid\Displayers\DropdownActions::class);

            $grid->actions(function ($actions) {
                //$actions->disableView();
                //$actions->add(new EmailAction());
            });

            //<a href="{{ route('impersonate', $user->id) }}">Impersonate this user</a>
//            $grid->column('Impersonate_');
            $grid->rows(function (Grid\Row $row) {
                //dd($row);
                $row->column(
                    'impersonate',
                    '<a href="'.url('/user/impersonate/'.$row->id).'">Go</a>'
                );

                $row->column(
                    '_accounts',
                    $row->accounts.'/'.(empty($row->subscriptionsettings['max_accounts']) ? 0 : $row->subscriptionsettings['max_accounts'])
                );
            });

            $grid->hideColumns(['username','accounts','subscriptionsettings.max_accounts']);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return new Form(new User(), function (Form $form) {

            if($form->isEditing())
                $apiToken = $form->model()->api_token;
            else
                $apiToken = Str::random(12);

            $form->display('id', 'ID');
            $form->hidden('manager_id')->value(User::GetManagerId());
            $form->hidden('api_token')->value($apiToken);

            $form->email('email', 'Email')
                ->creationRules(['required', "unique:admin_users"])
                ->updateRules(['required', "unique:admin_users,email,{{id}}"]);

            $form->text('username', 'Login')
                ->creationRules(['required', "unique:admin_users"])
                ->updateRules(['required', "unique:admin_users,username,{{id}}"]);

            $form->text('name', trans('admin.full_name'))->rules('required');
            //$form->switch('activated', 'Activated');
            $form->text('api_token_s', 'API token')
                ->disable()
                ->default(function ($form) use($apiToken) {
                    if($form->isEditing())
                        return $form->model()->api_token;
                    return $apiToken;
            });

            $form->password('password', trans('admin.password'))->rules('required|confirmed')
                ->default(function ($form) {
                    return $form->model()->password;
            });
            $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
                ->default(function ($form) {
                    return $form->model()->password;
                });

            $form->ignore(['password_confirmation', 'api_token_s']);

            if (Admin::user()->can('mng.copiers')) {
                $options = CopierSubscription::whereManagerId(Admin::user()->id)->pluck('title', 'id');
                $form->multipleSelect('copiersubscriptions', 'Copier Subscriptions')->options($options);

                $form->number('subscriptionsettings.max_copier_subscriptions', 'Max Copier Subscriptions');
            }

            if (Admin::user()->can('mng.emailsubscriptions')) {
                $options = EmailSubscription::whereManagerId(Admin::user()->id)->pluck('title', 'id');
                $form->multipleSelect('emailsubscriptions', 'Email Subscriptions')->options($options);

                $form->number('subscriptionsettings.max_email_subscriptions', 'Max Email Subscriptions')->default(1);
            }

            $form->number('subscriptionsettings.max_accounts', 'Max Accounts')->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
                $subscriptions = UserEmailSubscription::where('user_id', $form->model()->id)->get();

                foreach ($subscriptions as $subscription) {
                    if (empty($subscription->email)) {
                        $subscription->email = $form->model()->email;
                    }
                    $subscription->save();
                }

                $subscriptions = UserCopierSubscription::where('user_id', $form->model()->id)->get();

                foreach ($subscriptions as $subscription) {
                    $subscription->save();
                }

                if ($form->model()->wasRecentlyCreated) {

                    try {
                        ManagerMailer::handle(
                            $form->email,
                            new WelcomeMail(
                                $form->email,
                                $form->name,
                                $this->openPassword,
                                admin_url('/'),
                                User::GetManagerId())
                        );
                    } catch (\Exception $e) {
                        Log::error($e);
                    }
                }
            });

            $form->saving(function (Form $form) {
                $this->openPassword = $form->password;
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                }
            });
        });
    }

    public function add2copier_subscription(Request $request)
    {
        $ids = $request['ids'];

        if (empty($ids)) {
            return;
        }
        $subscriptionId = $request['subscription'];

        foreach (User::find($ids) as $user) {
            if (!$user->copiersubscriptions()->where('copier_subscription_id', $subscriptionId)->exists()) {
                $subscription = new UserCopierSubscription();
                $subscription->user_id = $user->id;
                $subscription->copier_subscription_id = $subscriptionId;

                $subscription->save();
            }
        }
    }

    public function add2email_subscription(Request $request)
    {
        $ids = $request['ids'];

        if (empty($ids)) {
            return;
        }
        $emailSubscriptionId = $request['subscription'];

        foreach (User::find($ids) as $user) {
            if (!$user->emailsubscriptions()->where('email_subscription_id', $emailSubscriptionId)->exists()) {
                $subscription = new UserEmailSubscription();
                $subscription->user_id = $user->id;
                $subscription->email = $user->email;
                $subscription->email_subscription_id = $emailSubscriptionId;

                $subscription->save();
            }
        }
    }

    /* ********************************** */

    /**
     * User setting page.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function getSetting(Content $content)
    {
        $form = $this->settingForm();
        $form->tools(
            function (Form\Tools $tools) {
                $tools->disableList();
                $tools->disableDelete();
                $tools->disableView();
            }
        );

        return $content
            ->title(__('admin.my_settings'))
            ->body($form->edit(Admin::user()->id));
    }

    /**
     * Update user setting.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putSetting()
    {
        return $this->settingForm()->update(Admin::user()->id);
    }

    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function settingForm()
    {
        $form = new Form(new User());

        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableReset();

        $form->display('username', trans('admin.username'));
        $form->text('name', trans('admin.full_name'))->rules('required');
        $form->email('email')->rules('required');
        $form->password('password', trans('admin.password'))->rules('required|confirmed')
            ->default(function ($form) {
                return $form->model()->password;
            });
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
                ->default(function ($form) {
                    return $form->model()->password;
                });

        $form->ignore(['password_confirmation']);
        $form->display('api_token', 'API token');
        $form->list('trusted_hosts', 'Trusted Hosts')->disable();
        $form->setAction(admin_url('user/setting'));

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('user/setting'));
        });

        return $form;
    }
}
