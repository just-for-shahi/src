<?php
namespace App\Models;

use App\User;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ManagerMailSetting
 *
 * @method static find(int $id)
 * @property int $manager_id
 * @property string|null $driver
 * @property string|null $smtp_host
 * @property int|null $smtp_port
 * @property string|null $smtp_encryption
 * @property string|null $smtp_username
 * @property string|null $smtp_password
 * @property string|null $from_email
 * @property string|null $from_name
 * @property string|null $main_template
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerMailSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerMailSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagerMailSetting query()
 * @mixin \Eloquent
 */
class ManagerMailSetting extends Model {

    protected $primaryKey = "manager_id";
    public $incrementing = false;

    protected $table = 'mail_settings';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}