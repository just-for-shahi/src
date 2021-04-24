<?php

namespace App\Admin\Controllers;

use App\Models\Member;
use App\Models\MemberProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use App\User;

use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class MemberController extends AdminController
{
    protected function title() {
        return trans('admin.members');
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form($id)->edit($id));
    }

    protected function grid() {
        return new Grid(new Member(), function (Grid $grid) {

            $grid->model()
                ->with('user')
                ->with('accounts')
                ->whereHas('user', static function ($user) {
                    $user->whereManagerId(Auth('admin')->user()->id);
                })
                ->orderBy('created_at', 'DESC');

            $grid->products('Products')->pluck('title')->badge('blue');
            $grid->user()->email('Email')->filter();
            $grid->user()->name('Name')->filter();
            $grid->activated_at('Activated')->display(function ($at) {
                if(is_null($at))
                    return "<span class='label label-warning' >Never</span>";
                return Carbon::parse($at)->diffForHumans();
            })->sortable();
            $grid->created_at('Created')->sortable();

            $grid->expired_at('Expired')
                ->display(function ($at) {
                    return Carbon::parse($at)->format('Y-m-d');
                })
                ->editable()->sortable();

            //$grid->expiration_days('Days')->sortable();
            $grid->max_live_accounts('Max Live')->editable();
            $grid->max_demo_accounts('Max Demo')->editable();
            $grid->single_pc('Single PC')->switch()->sortable();
            $grid->auto_confirm_new_accounts('Auto Confirm')->switch();
            $grid->license_key('License')->copyable();
            $grid->tags()->pluck('color')->display(function($tags) {
                $t = '';
                foreach ($tags as $color) {
                    $t .= "<span class='label' style='background-color:{$color}'>&nbsp;&nbsp;</span>";
                }

                return $t;
            });

            $grid->filter(function ($filter) {
                $filter->like('license_key', 'License');
                $filter->scope('Demo')->where('max_demo_accounts', '>', 0);
                $filter->scope('Live')->where('max_live_accounts', '>', 0);
                $filter->scope('SinglePC')->where('single_pc', '=', 1);
                $filter->scope('expiredtoday', 'Expired today')->whereDate('expired_at', date('Y-m-d'));
                $filter->scope('addedtoday', 'Added today')->whereDate('created_at', date('Y-m-d'));
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function ($row) {
                if($row->expiration_days == -1)
                    $row->column('expired_at', '<span class="label label-warning" >Never</span>');
            });
        });
    }

    protected function form($id = false)
    {
        return new Form(new Member(), function (Form $form) use($id) {
            $u = Auth('admin')->user();
            $form->hidden('manager_id')->value($u->id);

            $form->display('id', 'ID');

            if($id)
                $licenseKey = Member::find($id)->license_key;
            else
                $licenseKey = Member::GenerateLicenseKey();

            $form->hidden('license_key')->value($licenseKey);

            $form->text('license_s', 'License Key')
                ->disable()
                ->default($licenseKey);

            if ($form->isEditing()) {
                $form->display('user.email', 'Email');
                $form->hidden('user.email');
            } else {
                $form->email('user.email', 'Email')->creationRules(['required'])->required();
            }

            $form->text('user.name', 'Name')->required();
            $products = Product::whereManagerId(Auth('admin')->user()->id)->pluck('title', 'id');
            $form->multipleSelect('products', 'Products')
                ->options($products)
                ->required()
                ->allowSelectAll();

            $form->number('expiration_days', 'Expiration Days')
                ->default(7)
                ->help('Set -1 to make it lifetime license');

            $form->number('max_live_accounts', 'Max Live Accounts')->default(1);
            $form->number('max_demo_accounts', 'Max Demo Accounts')->default(1);
            $form->switch('single_pc', 'Single PC?')->default(1);
            $form->switch('auto_confirm_new_accounts', 'Auto Confirm New Accounts?')->default(1);
            $tags = Tag::whereManagerId(Auth('admin')->user()->id)->get();
            $idTitles = array();
            $idColors = array();
            foreach ($tags as $tag) {
                $idTitles[$tag->id] = $tag->title;
                $idColors[$tag->id] = $tag->color;
            }
            $form->multipleSelect('tags')
                ->options($idTitles)
                ->allowSelectAll()
                ->customItemColors($idColors)
                ->help('To add Tag, go to <a href="/tags">Tag Page</a>');

                        // $options  = UserBrokerServer
            //     ::with('broker_server')
            //     ->enabled()
            //     ->whereUserId($u->id)->get();
            // $arr = array();
            // foreach ($options as $option) {
            //     $arr[$option->broker_server->name] = $option->broker_server->name;
            // }
            // $form->multipleSelect('brokers', 'Brokers')->options($arr);
            $form->display('created_at', 'Started At');
            $form->display('created_at', 'Expired At');
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });

            $form->saving(function ($form) {

                if(!\request()->has('license_key')) {

                    $data = \request()->except(['_method','_token', '_editable']);
                    foreach ($data as $key => $val) {
                        if($val == 'on' || $val == 'off') {
                            $val = ($val == 'on' ? 1: 0);
                        }
                        $form->model()->{$key} = $val;
                        $form->model()->Save();
                    }
                    $response = [
                        'status'  => true,
                        'message' => trans('admin.update_succeeded'),
                    ];
                    return response()->json($response);
                }

                $email = $form->user['email'];
                $name = $form->user['name'];
                $username = Admin::user()->id.'_'.$email;

                $user = User::updateOrCreate(['username' => $username],
                [   'email' => $email,
                    'name' => $name,
                    'username' => $username,
                    'password' => bcrypt($email),
                    'manager_id' => Admin::user()->id,
                ]);

                $member = Member::firstOrNew(['license_key'=>$form->license_key]);
                $member->user_id = $user->id;
                $member->license_key = $form->license_key;
                $member->max_live_accounts = $form->max_live_accounts;
                $member->max_demo_accounts = $form->max_demo_accounts;
                $member->single_pc = ($form->single_pc == 'on' ? 1: 0);
                $member->auto_confirm_new_accounts = ($form->auto_confirm_new_accounts == 'on' ? 1: 0);
                $member->expiration_days = $form->expiration_days;
                $member->expired_at = Carbon::Now()->addDays($form->expiration_days);
                $member->Save();


                MemberProduct::where('member_id', $member->id)->delete();
                foreach ($form->products as $pId) {
                    if(!empty($pId))
                        MemberProduct::create(['product_id'=> $pId, 'member_id' => $member->id]);
                }

                $member->tags()->detach();
                foreach ($form->tags as $tagId) {
                    if(!empty($tagId))
                        $member->tags()->attach($tagId);
                }

                if($form->model()->id)
                    return redirect($form->resource(-1));

                return redirect($form->resource(0));
            });
        });
    }
}
