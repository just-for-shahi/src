<?php

namespace App\Admin\Actions;

use App\ManagerMailer;
use App\Models\ManagerMailTemplate;
use Carbon\Carbon;
use App\User;
use DB;
use Encore\Admin\Actions\Action;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use App\Models\LicensePreset;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\MemberProduct;
use App\Mail\LicenseMail;

class NewMember extends Action
{
    public $name = 'New Member';

    protected $selector = '.new_member';

    public function handle(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $presetId = $request->get('preset');
        $sendEmail = $request->get('after_submit');
        $emailTemplate = $request->get('email_template');

        if(empty($email)) {
            return $this->response()->failed('Email is required')->refresh();
        }

        if(!$presetId) {
            return $this->response()->failed('Preset is required')->refresh();
        }

        $user = User::firstOrCreate(
            ['username'=>$email],
            ['username' => $email,
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($email),
            'manager_id'=> Auth('admin')->user()->id,
            'creator_id'=> Auth('admin')->user()->id,
        ]);

        $preset = LicensePreset::with('products')->find($presetId);

        $member = new Member;
        $member->user_id = $user->id;
        $member->license_key = Member::GenerateLicenseKey();
        $member->expiration_days = $preset->expiration_days;
        $member->expired_at = Carbon::Now()->addDays($preset->expiration_days);
        $member->max_live_accounts = $preset->max_live_accounts;
        $member->max_demo_accounts = $preset->max_demo_accounts;
        $member->single_pc = $preset->single_pc;
        $member->auto_confirm_new_accounts = $preset->auto_confirm_new_accounts;
        $member->Save();

        $productKeys = array();
        foreach($preset->products()->get() as $product) {
            $m = new MemberProduct;

            $m->member_id = $member->id;
            $m->product_id = $product->id;
            $m->Save();

            $productKeys[] = $product->key;
        }

        if($sendEmail[0] == 1) {
            ManagerMailer::handle(
                $email,
                new LicenseMail(
                    $user->name,
                    $member->license_key,
                    $member->expired_at->format('Y-m-d'),
                    $preset->title,
                    $preset->description,
                    $productKeys,
                    Admin::user()->id,
                    $emailTemplate)
            );
        }
        return $this->response()->success('Successfully added')->refresh();
    }

    public function form()
    {
        $presets = LicensePreset::whereManagerId(Admin::user()->id)->pluck('title', 'id');
        $emailTemplates = ManagerMailTemplate
            ::whereManagerId(Admin::user()->id)
            ->where('mailable','App\\Mail\\LicenseMail')
            ->pluck('tag', 'tag');

        $this->text('name', 'Name')->required();
        $this->email('email', 'Email')->required();
        $this->select('preset', 'Preset')->options($presets)->required();
        $this->checkbox('after_submit', 'Post Action')->options(['1' => 'Send Email with License']);
        $this->select('email_template', 'EmailTemplate')->options($emailTemplates);
    }

    public function html()
    {
        return <<<HTML
<li>
    <a href="javascript:void(0);" class="new_member">
      <i class="fa fa-plus"></i>&nbsp;<span>New Member</span>
    </a>
</li>
HTML;
    }
}