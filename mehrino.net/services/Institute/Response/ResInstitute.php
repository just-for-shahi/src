<?php

namespace Services\Institute\Response;

/**
 * @OA\Schema(
 *     title="ResInstitute",
 *     description="ResInstitute",
 *     type="object"
 * )
 */
class ResInstitute
{

    /**
     * @OA\Property(
     *      title="uuid",
     *      description="uuid",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $uuid; //String

    /**
     * @OA\Property(
     *      title="title",
     *      description="title",
     *      example="title"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="logo",
     *      description="logo",
     *      type="string",
     *      example="https://ui.site.com/logo.png"
     * )
     */
    public $logo;

}
