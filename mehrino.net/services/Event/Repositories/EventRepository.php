<?php

namespace Services\Event\Repositories;

use Services\Event\Models\Event;
use App\Repository\Repository;

/**
 * Event
 * @author Sajadweb
 * Fri Dec 25 2020 02:39:05 GMT+0330 (Iran Standard Time)
 */
class EventRepository extends Repository implements IEventRepository
{
      /**
     * The model being queried.
     *
     * @var Event
     */
    public $model;
    public function __construct(Event $model)
    {
        $this->model = new $model();
    }
}