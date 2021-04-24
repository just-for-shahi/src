<?php


namespace Services\Support\Response;


/**
 * @OA\Schema(
 *      title="ReqReply",
 *      description="ReqReply request body data",
 *      type="object",
 *      required={"to","message"}
 * )
 */
class ReqReply
{

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
     *      title="attachment",
     *      description="attachment",
     *      type="file",
     *      format="binary"
     * )
     */
    public $attachment;//string
}


