<?php


namespace Services\Support\Response;

/**
 * @OA\Schema(
 *     title="ResTicket",
 *     description="ResTicket",
 * )
 */
class ResTicket
{
    /**
     * @OA\Property(
     *      title="uuid",
     *      description="uuid",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $uuid; //String
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
     *      example="message"
     * )
     * @var string
     */
    public $message; //String

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
    /**
     * @OA\Property(
     *      title="status",
     *      description="status",
     *      format="enum",
     *      enum={"waiting","solved", "working","noAnswer"},
     *      example="waiting"
     * )
     * @var string
     */
    public $status; //String
    /**
     * @OA\Property(
     *      title="createdAt",
     *      description="createdAt",
     *      example="Y-DD-MM H:i:s"
     * )
     * @var string
     */
    public $createdAt; //String
    /**
     * @OA\Property(
     *      title="updatedAt",
     *      description="updatedAt",
     *      example="Y-DD-MM H:i:s"
     * )
     * @var string
     */
    public $updatedAt; //String
}
