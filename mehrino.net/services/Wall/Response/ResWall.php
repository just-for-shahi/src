<?php

namespace Services\Wall\Response;

use Services\Swagger\CreatedAt;
use Services\Swagger\Institutes;
use Services\Swagger\Latitude;
use Services\Swagger\Longitude;
use Services\Swagger\Title;
use Services\Swagger\TraitUser;
use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResWall",
 *     description="ResWall",
 *     type="object"
 * )
 */
class ResWall
{
    use UUID, CreatedAt, TraitUser, Title, Latitude, Longitude;
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
     *      title="description",
     *      description="description",
     *      example=""
     * )
     *
     * @var string
     */
    public $description;
    /**
     * @OA\Property(
     *      title="type",
     *      description="type"
     * )
     *
     * @var number
     */
    public $type;
    /**
     * @OA\Property(
     *      title="private",
     *      description="private",
     *      example=true
     * )
     *
     * @var boolean
     */
    public $private;

    /**
     * @OA\Property(
     *      title="Institutes",
     *      description="Institutes",
     *      ref="#/components/schemas/ResInstitute"
     * )
     */
    public $institutes;
}
