<?php

namespace Services\Voluntary\Response;

/**
 * @OA\Schema(
 *     title="ReqStoreCertificateVoluntary",
 *     description="ReqStoreCertificateVoluntary",
 *     type="object"
 * )
 */
class ReqStoreCertificateVoluntary
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
     *      title="certificate",
     *      description="certificate string",
     *      example="certificate test"
     * )
     *
     * @var string
     */
    public $certificate;
}
