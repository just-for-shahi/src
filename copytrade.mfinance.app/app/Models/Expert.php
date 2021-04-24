<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

/**
 * App\Models\Expert
 *
 * @property int $id
 * @property string $name
 * @property int $ex4_file_id
 * @property int $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $enabled
 * @property string $template_default
 * @property int|null $automation_file_id
 * @property-read \App\Models\File|null $automation_file
 * @property-read \App\Models\File $ex4_file
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Expert query()
 * @mixin \Eloquent
 */
class Expert extends Model
{
    protected $table = 'experts';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function ex4_file()
    {
        return $this->belongsTo(File::class, 'ex4_file_id');
    }

}
