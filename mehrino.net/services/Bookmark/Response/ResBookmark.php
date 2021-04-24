<?php

namespace Services\Bookmark\Response;

/**
 * @OA\Schema(
 *     title="ResBookmark",
 *     description="ResBookmark",
 *     type="object"
 * )
 */
class ResBookmark
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
