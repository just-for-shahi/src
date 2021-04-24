<?php


namespace Services\User\Response;

/**
 * @OA\Schema(
 *      title="ReqUserVerify",
 *      description="ReqUserVerify request body data",
 *      type="object",
 *      required={"value", "otp"}
 * )
 */
class ReqUserVerify
{
    /**
     * @OA\Property(
     *      title="type",
     *      description="type of the mobile or email or username",
     *      example="mobile"
     * )
     *
     * @var string
     */
    public $type;
    /**
     * @OA\Property(
     *      title="value",
     *      description="value of the mobile or email",
     *      example="989332369461"
     * )
     *
     * @var string
     */
    public $value; //String
    /**
     * @OA\Property(
     *      title="otp",
     *      description="otp of the code",
     *      example="9461"
     * )
     *
     * @var string
     */
    public $otp;
    /**
     * @OA\Property(
     *      title="password",
     *      deprecated=true,
     *      description="it used in forget password"
     * )
     *
     * @var string
     */
    public $password; //String
}
