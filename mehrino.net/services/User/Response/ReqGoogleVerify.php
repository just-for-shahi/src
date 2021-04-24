<?php

/**
 * @OA\Schema(
 *      title="ReqGoogleVerify",
 *      description="ReqGoogleVerify request body data",
 *      type="object",
 *      required={"token"}
 * )
 */
class ReqGoogleVerify
{

    /**
     * @OA\Property(
     *      title="token",
     *      description="google token",
     *      example="google token"
     * )
     *
     * @var string
     */
    public $token; //String
}
