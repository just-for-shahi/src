<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="TraitUser",
 *     description="TraitUser"
 * )
 */
trait TraitUser
{
    /**
     * @OA\Property(
     *      title="ResUser",
     *      ref="#/components/schemas/ResUser"
     * )
     */
    public $user; //User
}
