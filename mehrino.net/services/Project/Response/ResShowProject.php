<?php

namespace Services\Project\Response;


use Services\Swagger\IsBookmark;
use Services\Swagger\IsLike;
use Services\Swagger\IsVisit;
use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResShowProject",
 *     description="ResShowProject",
 *     type="object"
 * )
 */
class ResShowProject extends ReqStoreProject
{
    use UUID, IsLike, IsBookmark, IsVisit;
    /**
     * @OA\Property(
     *      title="like",
     *      description="like",
     *      example=1
     * )
     *
     * @var number
     */
    public $likes;

    /**
     * @OA\Property(
     *      title="Visits",
     *      description="Visits",
     *      example=1
     * )
     *
     * @var number
     */
    public $visits;


}
