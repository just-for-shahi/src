<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="IsDisLike",
 *     description="IsDisLike"
 * )
 */
trait IsDisLike
{
    /**
     * @OA\Property(
     *      title="is_dislike",
     *      description="is_dislike",
     *      example=false
     * )
     *
     * @var boolean
     */
    public $is_dislike;

    /**
     * @OA\Property(
     *      title="dislike",
     *      description="dislike",
     *      example=1
     * )
     *
     * @var number
     */
    public $dislikes;
}
