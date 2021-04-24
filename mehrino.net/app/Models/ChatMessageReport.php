<?php


namespace App\Models;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatMessageReport extends Model
{

    use UUID, SoftDeletes;

    protected $table = 'chat_message_reports';

    protected $fillable = ['message', 'user', 'sent_at', 'receive_at', 'seen_at'];

}
