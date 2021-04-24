<?php

namespace Services\Institute\Response;

use Services\Institute\Response\Social;

/**
 * @OA\Schema(
 *     title="InstituteBranch",
 *     description="InstituteBranch",
 *     type="object"
 * )
 */
class InstituteBranch extends Social
{
    /**
     * @OA\Property(
     *      title="uuid",
     *      description="only for update",
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
     * @var string
     */
    public $title;
    /**
     * @OA\Property(
     *      title="phone",
     *      description="phone",
     *      example="phone"
     * )
     *
     * @var string
     */
    public $phone;
    /**
     * @OA\Property(
     *      title="address",
     *      description="address",
     *      example="address"
     * )
     *
     * @var string
     */
    public $address;
    /**
     * @OA\Property(
     *      title="manager",
     *      description="manager",
     *      example="name"
     * )
     *
     * @var string
     */
    public $manager;

    /**
     * @OA\Property(
     *      title="linkedin",
     *      deprecated=true,
     *      description="linkedin",
     *      example="sajadweb.linkedin.com"
     * )
     *
     * @var string
     */
    public $linkedin;
    /**
     * @OA\Property(
     *      title="youtube",
     *      deprecated=true,
     *      description="youtube",
     *      example="sajadweb.youtube.com"
     * )
     *
     * @var string
     */
    public $youtube;

    /**
     * @OA\Property(
     *      title="work_hours",
     *      description="work_hours",
     *     ref="#/components/schemas/InstituteWorkHours"
     * )
     */
    public $work_hours;
}
