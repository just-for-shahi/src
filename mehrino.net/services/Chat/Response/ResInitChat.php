<?php

namespace Services\Chat\Response;

/**
 * @OA\Schema(
 *     title="ResInitChat",
 *     description="ResInitChat",
 *     type="object"
 * )
 */
class ResInitChat
{
     /**
     * @OA\Property(
     *      title="token",
     *      description="token",
     *      example="1wry9zmet5s-up5jpsymbf5spks-sdfs4"
     * )
     *
     * @var string
     */
    public $token;
}
