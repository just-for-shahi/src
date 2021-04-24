<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="Longitude",
 *     description="Longitude"
 * )
 */
trait Longitude
{
    /**
     * @OA\Property(
     *      title="longitude",
     *      description="longitude",
     *      example="54.23"
     * )
     *
     * @var number
     */
    public $longitude;
}
