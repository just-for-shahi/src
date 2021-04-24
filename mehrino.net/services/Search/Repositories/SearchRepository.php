<?php

namespace Services\Search\Repositories;

use Services\Search\Models\Search;
use App\Repository\Repository;

/**
 * Search
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:34 GMT+0330 (Iran Standard Time)
 */
class SearchRepository extends Repository implements ISearchRepository
{
      /**
     * The model being queried.
     *
     * @var Search
     */
    public $model;
    public function __construct(Search $model)
    {
        $this->model = new $model();
    }
}