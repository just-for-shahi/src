<?php

namespace Services\Project\Response;


use Services\Swagger\Institutes;
use Services\Swagger\Latitude;
use Services\Swagger\Longitude;
use Services\Swagger\Title;
use Services\Swagger\Content;

/**
 * @OA\Schema(
 *     title="ReqStoreProject",
 *     description="ReqStoreProject",
 *     type="object"
 * )
 */
class ReqStoreProject
{
    use Title, Institutes, Longitude, Latitude, Content;
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
     *      title="type",
     *      description="type",
     *      example=0
     * )
     * @var number
     */
    public $type;
    /**
     * @OA\Property(
     *     description="Item image",
     *     property="galleries[]",
     *     type="array",
     *     @OA\Items(type="string", format="uuid")
     *)
     */
    public $galleries;
}
