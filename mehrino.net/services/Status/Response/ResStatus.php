<?php

namespace Services\Status\Response;

/**
 * @OA\Schema(
 *     title="ResStatus",
 *     description="ResStatus",
 *     type="object"
 * )
 */
class ResStatus
{
    /**
     * @OA\Property(
     *      title="Institute",
     *      description="Institute",
     *      ref="#/components/schemas/ResProject"
     * )
     */
    public $project;

    /**
     * @OA\Property(
     *      title="Institute",
     *      description="Institute",
     *      ref="#/components/schemas/ResWall"
     * )
     */
    public $wall;


    /**
     * @OA\Property(
     *      title="voluntary",
     *      description="voluntary",
     *      ref="#/components/schemas/ResVoluntary"
     * )
     */
    public $voluntary;
}
