<?php


namespace Services\Support\Response;

/**
 * @OA\Schema(
 *      title="ReqCallRequest",
 *      description="ReqCallRequest request body data",
 *      type="object",
 *      required={"phone"}
 * )
 */
class ReqCallRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="name",
     *      example="sajjad"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="message",
     *      description="message",
     *      type="string",
     *      example="message"
     * )
     */
    public $message;//string
    /**
     * @OA\Property(
     *      title="phone",
     *      description="phone",
     *      example="989332369461"
     * )
     *
     * @var string
     */
    public $phone; //String
}
