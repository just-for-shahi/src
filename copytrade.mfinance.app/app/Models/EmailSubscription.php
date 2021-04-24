<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\JfxMode;
use App\Models\AccountStatus;
use DateTimeInterface;

/**
 * App\Models\EmailSubscription
 *
 * @property int $id
 * @property int $manager_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $template_signal_new
 * @property string|null $template_signal_updated
 * @property string|null $template_signal_closed
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $sources
 * @property-read int|null $sources_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailSubscription query()
 * @method static whereManagerId($id)
 * @mixin \Eloquent
 */
class EmailSubscription extends Model
{
    protected $table = 'email_subscriptions';

    protected $fillable = ['manager_id', 'name'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function sources()
    {
        return $this->belongsToMany(Account::class, 'email_subscription_source_accounts');
    }

    public function refreshWebHooks()
    {
        foreach ($this->sources()->get() as $item) {
            $item->jfx_mode = $item->jfx_mode|JfxMode::WEBHOOK_ENABLED;
            //todo::reload settings on vps
            //$item->account_status = AccountStatus::PENDING;
            $item->save();
        }
    }

    public function scopePublic() {
        return $this->where('is_public', 1);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($query) {
            //       $query->account_status = AccountStatus::PENDING;
        });
    }
}
