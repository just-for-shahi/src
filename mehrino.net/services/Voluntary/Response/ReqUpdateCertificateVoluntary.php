<?php

namespace Services\Voluntary\Response;

/**
 * @OA\Schema(
 *     title="ReqUpdateCertificateVoluntary",
 *     description="ReqUpdateCertificateVoluntary",
 *     type="object"
 * )
 */
class ReqUpdateCertificateVoluntary
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
     *      title="certificate",
     *      description="certificate string",
     *      example="certificate test"
     * )
     *
     * @var string
     */
    public $certificate;

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
