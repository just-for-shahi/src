<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="Title",
 *     description="Title"
 * )
 */
trait Title
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="title",
     *      example="title"
     * )
     *
     * @var string
     */
    public $title;
}
