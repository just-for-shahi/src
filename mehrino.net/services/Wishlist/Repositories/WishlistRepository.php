<?php

namespace Services\Wishlist\Repositories;

use Services\Wishlist\Models\Wishlist;
use App\Repository\Repository;

/**
 * Wishlist
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:39 GMT+0330 (Iran Standard Time)
 */
class WishlistRepository extends Repository implements IWishlistRepository
{
      /**
     * The model being queried.
     *
     * @var Wishlist
     */
    public $model;
    public function __construct(Wishlist $model)
    {
        $this->model = new $model();
    }
}