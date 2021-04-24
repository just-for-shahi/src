<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="IsBookmark",
 *     description="IsBookmark"
 * )
 */
trait IsBookmark
{
    /**
     * @OA\Property(
     *      title="is_bookmarck",
     *      description="is_bookmarck",
     *      example=false
     * )
     *
     * @var boolean
     */
    public $is_bookmark;
}
