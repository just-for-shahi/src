<?php

namespace Services\Institute\Response;

use Services\Institute\Response\Institute;

/**
 * @OA\Schema(
 *     title="ReqStoreInstitute",
 *     description="ReqStoreInstitute",
 *     type="object",
 *     required={"title","registered_no","license_no","ceo"}
 * )
 */
class ReqStoreInstitute extends Institute
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
