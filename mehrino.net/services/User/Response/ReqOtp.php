<?php


namespace Services\User\Response;

/**
 * @OA\Schema(
 *      title="ReqOtp",
 *      description="ReqOtpt request body data",
 *      type="object",
 *      required={"value"}
 * )
 */
class ReqOtp
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

}
