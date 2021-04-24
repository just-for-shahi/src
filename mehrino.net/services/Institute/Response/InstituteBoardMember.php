<?php

namespace Services\Institute\Response;

/**
 * @OA\Schema(
 *     title="InstituteBoardMember",
 *     description="InstituteBoardMember",
 * )
 */
class InstituteBoardMember extends Social
{
//    protected $fillable = ['institutes', 'name', 'position', 'introduction', 'avatar', 'website',
//        'instagram', 'telegram', 'aparat', 'linkedin'];
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
     *      title="name",
     *      description="name",
     *      example="sajadweb"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="position",
     *      description="position",
     *      example="position"
     * )
     *
     * @var string
     */
    public $position;
    /**
     * @OA\Property(
     *      title="introduction",
     *      description="introduction",
     *      example="introduction"
     * )
     *
     * @var string
     */
    public $introduction;
    /**
     * @OA\Property(
     *      title="avatar",
     *      description="avatar",
     *      example="avatar"
     * )
     *
     * @var string
     */
    public $avatar; // TODO change file
    /**
     * @OA\Property(
     *      title="whatsapp",
     *      deprecated=true,
     *      description="whatsapp",
     *      example="sajadweb.whatsapp.com"
     * )
     *
     * @var string
     */
    public $whatsapp;
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
}
