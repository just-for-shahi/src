<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="CreatedAt",
 *     description="CreatedAt"
 * )
 */
trait CreatedAt
{
    /**
     * @OA\Property(
     *      title="CreatedAt",
     *      description="CreatedAt",
     *      example="2021-01-06T09:06:32.000000Z"
     * )
     *
     * @var string
     */
    public $createdAt;
}
