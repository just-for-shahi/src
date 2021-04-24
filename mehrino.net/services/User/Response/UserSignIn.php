<?php


namespace Services\User\Response;



/**
 * @OA\Schema(
 *      title="UserSignIn",
 *      description="UserSignIn request body data",
 *      type="object",
 *      required={"username","password"}
 * )
 */
class UserSignIn
{
    /**
     * @OA\Property(
     *      title="type",
     *      description="type of the mobile or email",
     *      example="mobile"
     * )
     *
     * @var string
     */
    public $type;

    /**
     * @OA\Property(
     *      title="value",
     *      description="mobile or email",
     *      example="989332369461"
     * )
     *
     * @var string
     */
    public $value;
    /**
     * @OA\Property(
     *      title="password",
     *      description="password",
     *      example="123456"
     * )
     *
     * @var string
     */
    public $password; //String
}

