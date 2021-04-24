<?php


namespace Services\Attachment\Models;

use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attachment
 * @package Services\Ticket\Model
 */
class Attachment extends Model
{
    use SoftDeletes, UUID, Me;
    protected $fillable = ['path', 'uuid','user', 'type', 'attachable_type', 'attachable_id'];
}
