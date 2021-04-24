<?php
namespace App\Models;

use App\User;
use Spatie\MailTemplates\Models\MailTemplate;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MailTemplates\Interfaces\MailTemplateInterface;
use DateTimeInterface;

/**
 * App\Models\ManagerMailTemplate
 *
 * @property int $id
 * @property string $mailable
 * @property string|null $subject
 * @property string $html_template
 * @property string|null $text_template
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $manager_id
 * @property-read array $variables
 * @property-read \App\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate forMailable(\Illuminate\Contracts\Mail\Mailable $mailable)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ManagerMailTemplate query()
 * @method whereManagerId(int $id)
 * @mixin \Eloquent
 * @property string|null $tag
 */
class ManagerMailTemplate extends MailTemplate implements MailTemplateInterface {

    protected $table = 'mail_templates';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function scopeForMailable(Builder $query, Mailable $mailable): Builder
    {
        $query->where('mailable', get_class($mailable))
            ->where('manager_id', $mailable->getManagerId());

        if(!is_null($mailable->getTag())) {
            $query->where('tag', $mailable->getTag());
        }

        return $query;
    }

}