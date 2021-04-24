<?php


namespace Services\User\Response;


use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResUserShow",
 *     description="ResUserShow",
 * )
 */
class ResUserShow
{
    use UUID;
    /**
     * @OA\Property(
     *      title="mobile",
     *      description="mobile",
     *      example="98932369461"
     * )
     *
     * @var string
     */
    public $mobile;
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
     *      title="fee",
     *      description="fee",
     *      example=""
     * )
     *
     * @var integer
     */
    public $fee;
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
     *      title="balance",
     *      description="balance",
     *      example="50000"
     * )
     *
     * @var integer
     */
    public $balance;
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
     *      title="email",
     *      description="email",
     *      example="email@gmail.com"
     * )
     *
     * @var string
     */
    public $email;



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
     *      title="latitude",
     *      description="latitude",
     *      example="23.126548"
     * )
     *
     * @var string
     */
    public $latitude;
    /**
     * @OA\Property(
     *      title="longitude",
     *      description="longitude",
     *      example="54.258455"
     * )
     *
     * @var string
     */
    public $longitude;

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
