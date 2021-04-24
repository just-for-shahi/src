<?php


namespace Services\Swagger;

/**
 * @OA\Schema(
 *     title="Galleries",
 *     description="Galleries"
 * )
 */
trait Galleries
{
    /**
     * @OA\Property(
     *     description="Item image",
     *     property="galleries[]",
     *     type="array",
     *     @OA\Items(type="string", format="uuid")
     *)
     */
    public $galleries;
}
