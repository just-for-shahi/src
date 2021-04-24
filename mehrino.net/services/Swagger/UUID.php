<?php


namespace Services\Swagger;


/**
 * @OA\Schema(
 *     title="UUID",
 *     description="UUID"
 * )
 */
trait UUID
{
    /**
     * @OA\Property(
     *      title="uuid",
     *      description="uuid",
     *      format="UUID",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $uuid;

}
