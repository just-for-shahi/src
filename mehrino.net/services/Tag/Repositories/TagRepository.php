<?php

namespace Services\Tag\Repositories;

use Services\Tag\Models\Tag;
use App\Repository\Repository;

/**
 * Tag
 * @author Sajadweb
 * Fri Dec 25 2020 02:42:18 GMT+0330 (Iran Standard Time)
 */
class TagRepository extends Repository implements ITagRepository
{
      /**
     * The model being queried.
     *
     * @var Tag
     */
    public $model;
    public function __construct(Tag $model)
    {
        $this->model = new $model();
    }
}