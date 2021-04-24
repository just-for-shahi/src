<?php

namespace Services\Institute\Response;

use Services\Institute\Response\Institute;

/**
 * @OA\Schema(
 *     title="ReqUpdateInstitute",
 *     description="ReqUpdateInstitute",
 *     type="object"
 * )
 */
class ReqUpdateInstitute extends Institute
{
    /**
     * @OA\Property(
     *      title="uuid",
     *      description="uuid",
     *      deprecated=true
     * )
     * @var string
     */
    public $uuid; //String

}
