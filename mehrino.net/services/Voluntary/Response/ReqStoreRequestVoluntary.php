<?php

namespace Services\Voluntary\Response;

/**
 * @OA\Schema(
 *     title="ReqStoreRequestVoluntary",
 *     description="ReqStoreRequestVoluntary",
 *     type="object"
 * )
 */
class ReqStoreRequestVoluntary
{
    /**
     * @OA\Property(
     *      title="voluntary",
     *      description="voluntary",
     *      format="UUID",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $voluntary;

    /**
     * @OA\Property(
     *      title="resume",
     *      description="resume image",
     *      type="file",
     *      format="binary"
     * )
     */
    public $resume;

    /**
     * @OA\Property(
     *      title="private",
     *      description="private",
     *      example=false
     * )
     *
     * @var boolean
     */
    public $private;
}
