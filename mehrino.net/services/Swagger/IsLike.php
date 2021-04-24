<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="IsLike",
 *     description="IsLike"
 * )
 */
trait IsLike
{
    /**
     * @OA\Property(
     *      title="is_like",
     *      description="is_like",
     *      example=false
     * )
     *
     * @var boolean
     */
    public $is_like;


}
