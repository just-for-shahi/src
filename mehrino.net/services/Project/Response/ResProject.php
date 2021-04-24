<?php

namespace Services\Project\Response;

use Services\Swagger\IsBookmark;
use Services\Swagger\IsLike;
use Services\Swagger\Latitude;
use Services\Swagger\Longitude;
use Services\Swagger\Title;
use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResProject",
 *     description="ResProject",
 *     type="object"
 * )
 */
class ResProject
{

    use Title, Longitude, Latitude, UUID, IsLike, IsBookmark;


    /**
     * @OA\Property(
     *      title="cover",
     *      description="cover",
     *      type="file",
     *      format="binary"
     * )
     */
    public $cover;
    /**
     * @OA\Property(
     *      title="target",
     *      description="target",
     *      example="50000"
     * )
     *
     * @var number
     */
    public $target;

    /**
     * @OA\Property(
     *      title="current_balance",
     *      description="current_balance",
     *      example="50000"
     * )
     *
     * @var number
     */
    public $current_balance;
    /**
     * @OA\Property(
     *      title="current_balance",
     *      description="current_balance",
     *      example="50000"
     * )
     *
     * @var number
     */
    public $collaborators;
    /**
     * @OA\Property(
     *      title="Institute",
     *      description="Institute",
     *      ref="#/components/schemas/ResInstitute"
     * )
     */
    public $institute;
}
