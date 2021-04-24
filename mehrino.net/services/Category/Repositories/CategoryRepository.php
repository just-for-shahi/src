<?php

namespace Services\Category\Repositories;

use Services\Category\Models\Category;
use App\Repository\Repository;

/**
 * Category
 * @author Sajadweb
 * Fri Dec 25 2020 02:37:20 GMT+0330 (Iran Standard Time)
 */
class CategoryRepository extends Repository implements ICategoryRepository
{
      /**
     * The model being queried.
     *
     * @var Category
     */
    public $model;
    public function __construct(Category $model)
    {
        $this->model = new $model();
    }
}