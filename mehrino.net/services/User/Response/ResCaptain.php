<?php


namespace Services\User\Response;


/**
 * @OA\Schema(
 *     title="ResCaptain",
 *     description="ResCaptain",
 *     @OA\Xml(
 *         name="ResCaptain"
 *     )
 * )
 */
class ResCaptain
{

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
     *      title="photo",
     *      description="photo",
     *      example="photo.png"
     * )
     *
     * @var string
     */
    public $photo; //String
    /**
     * @OA\Property(
     *      title="joined",
     *      description="joined",
     *      example=""
     * )
     *
     * @var string[]
     */
    public $joined; //array( undefined )
    /**
     * @OA\Property(
     *      title="lastConnection",
     *      description="lastConnection",
     *      example=""
     * )
     *
     * @var string[]
     */
    public $lastConnection; //array( undefined )
}
