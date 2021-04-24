<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expert;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\File;
use App\Jobs\ProcessPendingAccount;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class AccountExpertTemplate extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'expert_templates';

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function template_file()
    {
        return $this->belongsTo(File::class, 'tpl_file_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(static function($query) {
            //$query->automation_file_options = self::parseCredentials($query->options);
        });

        static::saved(function (AccountExpertTemplate $template) {

            $account = Account::find($template->account_id);

            $account->account_status = AccountStatus::PENDING;
            $account->processing = true;
            $account->save();

            ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
        });

        static::creating(function ($query) {
        });
    }
}