<?php


namespace Services\User\Response;


/**
 * @OA\Schema(
 *     title="ResUserVerify",
 *     description="ResUserVerify",
 *     @OA\Xml(
 *         name="ResUserVerify"
 *     )
 * )
 */
class ResUserVerify
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
     *      title="token",
     *      description="token",
     *      example="token"
     * )
     *
     * @var string
     */
    public $token; //String
    /**
     * @OA\Property(
     *      title="mobile",
     *      description="mobile",
     *      example="9332369461"
     * )
     *
     * @var string
     */
    public $mobile; //String
    /**
     * @OA\Property(
     *      title="prefixMobile",
     *      description="prefixMobile",
     *      example="98"
     * )
     *
     * @var string
     */
    public $prefixMobile; //String
    /**
     * @OA\Property(
     *      title="email",
     *      description="email",
     *      example="sajadweb7@gmail.com"
     * )
     *
     * @var string
     */
    public $email; //String
    /**
     * @OA\Property(
     *      title="name",
     *      description="name",
     *      example="name"
     * )
     *
     * @var string
     */
    public $name; //String
    /**
     * @OA\Property(
     *      title="avatar",
     *      description="avatar",
     *      example="avatar.png"
     * )
     *
     * @var string
     */
    public $avatar; //String
    /**
     * @OA\Property(
     *      title="username",
     *      description="username",
     *      example="sajadweb"
     * )
     *
     * @var string
     */
    public $username; //String
    /**
     * @OA\Property(
     *      title="team",
     *      description="team",
     *      example=""
     * )
     *
     * @var string
     */
    public $team; //int
    /**
     * @OA\Property(
     *      title="captain",
     *      description="captain",
     *      example="captain"
     * )
     *
     * @var string
     */
    public $captain; //array( undefined )

    /**
     * @OA\Property(
     *      title="balance",
     *      description="balance",
     *      example=""
     * )
     *
     * @var number
     */
    public $balance; //int
}
