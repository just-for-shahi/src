<?php


namespace Services\Support\Response;
/**
 * @OA\Schema(
 *     title="ResReply",
 *     description="ResReply",
 * )
 */
class ResReply
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
     *      title="ResUser",
     *      ref="#/components/schemas/ResUser"
     * )
     */
    public $user; //User
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
     *      example="department"
     * )
     * @var string
     */
    public $attachment; //String
    /**
     * @OA\Property(
     *      title="createdAt",
     *      description="createdAt",
     *      example="Y-DD-MM H:i:s"
     * )
     * @var string
     */
    public $createdAt; //String
}
