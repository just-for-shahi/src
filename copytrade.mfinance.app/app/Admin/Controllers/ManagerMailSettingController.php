<?php

namespace App\Admin\Controllers;

use App\Models\ManagerMailSetting;
use Encore\Admin\Form;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class ManagerMailSettingController extends Controller
{
    use HasResourceActions;

    public function index()
    {
        return new Content(function (Content $content) {
            $form = $this->form();
            $form->disableCreatingCheck();
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableReset();

            $form->tools(
                function (Form\Tools $tools) {
                    $tools->disableList();
                    $tools->disableDelete();
                    $tools->disableView();
                }
            );

            $settings = ManagerMailSetting::find(Admin::user()->id);
            $content->title('Mail Settings');

            if($settings) {
                $content->body($form->edit(Admin::user()->id));
            } else {
                $content->body($form);
            }
        });
    }

    public function putSetting()
    {
        $settings = ManagerMailSetting::find(Admin::user()->id);
        if($settings) {
            return $this->form()->update(Admin::user()->id);
        }

        return $this->form();
    }

    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function form()
    {
        //$class = config('admin.database.users_model');

        $form = new Form(new ManagerMailSetting());

        $form->hidden('manager_id')->value(Admin::user()->id);
        $drivers = ['smtp'=>'smtp', 'sendmail' => 'sendmail', 'mailgun'=>'mailgun'];
        $ecnryptions = ['tls'=>'tls', 'ssl'=>'ssl'];

        $form->select('driver', 'Driver')->options($drivers)->required();
        $form->text('smtp_host', 'SMTP Host')->required();
        $form->number('smtp_port', 'SMTP Port')->required();
        $form->select('smtp_encryption', 'Encryption')->options($ecnryptions)->required();
        $form->text('smtp_username', 'SMTP User')->required();
        $form->text('smtp_password', 'SMTP Password')->required();
        $form->email('from_email', 'Send From')->help('If empty SMTP User will be used');
        $form->text('from_name', 'From Name')->required();
        $form->tinymce('main_template', 'Base Layout');
        $form->setAction(admin_url('email_settings'));

        $form->saving(function (Form $form) {
            $form->manager_id = Admin::user()->id;
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('email_settings'));
        });

        return $form;
    }
}
