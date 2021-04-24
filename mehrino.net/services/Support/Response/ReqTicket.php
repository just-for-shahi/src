<?php


namespace Services\Support\Response;

/**
 * @OA\Schema(
 *      title="ReqTicket",
 *      description="ReqTicket request body data",
 *      type="object",
 *      required={"to","message"}
 * )
 */
class ReqTicket
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="title",
     *      example="title"
     * )
     * @var string
     */
    public $title; //String
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
     *      title="department",
     *      description="department",
     *      format="enum",
     *      enum={"general", "finance", "events", "corporationsl", "managers"},
     *      example="general"
     * )
     * @var string
     */
    public $department; //String
    /**
     * @OA\Property(
     *      title="priority",
     *      description="priority",
     *      format="enum",
     *      enum={"normal", "nonSignificant","important"},
     *      example="normal"
     * )
     * @var string
     */
    public $priority; //String
}
