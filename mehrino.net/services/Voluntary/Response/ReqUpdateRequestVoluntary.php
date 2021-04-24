<?php

namespace Services\Voluntary\Response;

/**
 * @OA\Schema(
 *     title="ReqUpdateCertificateVoluntary",
 *     description="ReqUpdateCertificateVoluntary",
 *     type="object"
 * )
 */
class ReqUpdateRequestVoluntary
{
    /**
     * @OA\Property(
     *      title="voluntaryWork",
     *      description="voluntaryWork",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $voluntaryWork;

    /**
     * @OA\Property(
     *      title="resume",
     *      description="resume string",
     *      example="resume test"
     * )
     *
     * @var string
     */
    public $resume;

    /**
     * @OA\Property(
     *      title="reject",
     *      description="reject",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $reject;

    /**
     * @OA\Property(
     *      title="private",
     *      description="private",
     *      example="false"
     * )
     *
     * @var boolean
     */
    public $private;

    /**
     * @OA\Property(
     *      title="status",
     *      description="status",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $status;
}
