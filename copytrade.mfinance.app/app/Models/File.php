<?php

namespace App\Models;

use App\Enums\FileType;
use DateTimeInterface;
use App\Models\BrokerSymbol;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string|null $path
 * @property mixed $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property int|null $is_updated_or_new
 * @property string $name
 * @property int $manager_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $table = 'files';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    static public function generatePairsFile($managerId, $brokerName, $suffix, $prefix = '') {
        $file = new File;

        $pairs = BrokerSymbol::enabled()->get();

        $data = '';
        foreach($pairs as $pair) {
            $data .= $prefix . $pair->name . $suffix . "\r\n";
        }

        $file->data = $data;
        $file->manager_id = $managerId;
        $file->type = FileType::PAIRS;

        $brokerName = str_replace('.', '_', $brokerName);
        $file->name = $brokerName.'.sym.txt';

        $file->save();

        return $file->id;
    }
}
