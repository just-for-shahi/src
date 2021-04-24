<?php


namespace Services\Swagger;


/**
 * @OA\Schema(
 *     title="IsVisit",
 *     description="IsVisit"
 * )
 */
trait IsVisit
{
    /**
     * @OA\Property(
     *      title="visit",
     *      description="visit",
     *      type="boolean",
     *      example=false
     * )
     */
    public $visits;
}
