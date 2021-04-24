<?php


namespace Services\User\Response;


use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResUserShowProfile",
 *     description="ResUserShowProfile",
 * )
 */
class ResUserShowProfile
{
    use UUID;

    /**
     * @OA\Property(
     *      title="name",
     *      description="name"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="country",
     *      description="country",
     *      example="iran"
     * )
     *
     * @var string
     */
    public $country;

    /**
     * @OA\Property(
     *      title="username",
     *      description="username"
     * )
     *
     * @var string
     */
    public $username;
    /**
     * @OA\Property(
     *      title="team",
     *      description="team",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $team;

    /**
     * @OA\Property(
     *      title="blue",
     *      description="blue",
     *      example="false"
     * )
     *
     * @var boolean
     */
    public $blue;

    /**
     * @OA\Property(
     *      title="plus",
     *      description="plus",
     *      example="1399/09/08"
     * )
     *
     * @var string
     */
    public $plus;
    /**
     * @OA\Property(
     *      title="avatar",
     *      description="avatar",
     *      example="file"
     * )
     *
     * @var string
     */
    public $avatar;


    /**
     * @OA\Property(
     *      title="private",
     *      description="private",
     *      example="false"
     * )
     *
     * @var boolean
     */
    public $private;

    /**
     * @OA\Property(
     *      title="posts",
     *      description="count posts",
     *      example="100"
     * )
     *
     * @var number
     */
    public $posts;

   /**
     * @OA\Property(
     *      title="followers",
     *      description="followers",
     *      example="100"
     * )
     *
     * @var number
     */
    public $followers;
}
