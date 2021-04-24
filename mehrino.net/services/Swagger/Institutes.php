<?php


namespace Services\Swagger;


/**
 * @OA\Schema(
 *     title="Institutes",
 *     description="Institutes"
 * )
 */
trait Institutes
{
    /**
     * @OA\Property(
     *      title="institutes",
     *      description="institutes",
     *      format="UUID",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $institutes;

}
