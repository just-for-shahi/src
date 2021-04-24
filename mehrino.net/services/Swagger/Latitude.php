<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="Latitude",
 *     description="Latitude"
 * )
 */
trait Latitude
{
    /**
     * @OA\Property(
     *      title="latitude",
     *      description="latitude",
     *      example="23.23"
     * )
     *
     * @var number
     */
    public $latitude;
}
