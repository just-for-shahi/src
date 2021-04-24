<?php


namespace App\Http\Controllers\Event;


use Illuminate\Database\Eloquent\Model;

class EventFaq extends Model
{

    protected $table = 'event_faqs';
    protected $fillable = ['event', 'question', 'answer', 'sort'];

}