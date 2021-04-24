<?php

namespace Services\Setting\Response;

/**
 * @OA\Schema(
 *     title="Setting",
 *     description="Setting",
 *     type="object"
 * )
 */
class Setting
{
    /**
     * @OA\Property(
     *      title="theme",
     *      description="theme settings",
     *      type="string",
     *      enum={"light","dark"},
     *      example="light"
     * )
     */
    public $theme;

    /**
     * @OA\Property(
     *      title="kids_mode",
     *      description="kids_mode settings",
     *      example=true
     * )
     *
     * @var boolean
     */
    public $kids_mode;

    /**
     * @OA\Property(
     *      title="notifications",
     *      description="notifications settings",
     *      example=true
     * )
     *
     * @var boolean
     */
    public $notifications;

    /**
     * @OA\Property(
     *      title="sms",
     *      description="sms settings",
     *      example=true
     * )
     *
     * @var boolean
     */
    public $sms;

    /**
     * @OA\Property(
     *      title="ads",
     *      description="ads settings",
     *      example=true
     * )
     *
     * @var boolean
     */
    public $ads;
}
