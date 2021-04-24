<?php

namespace Services\Institute\Response;

use Services\Institute\Response\Institute;

/**
 * @OA\Schema(
 *     title="ResShowInstitute",
 *     description="ResShowInstitute",
 *     type="object"
 * )
 */
class ResShowInstitute extends Institute
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
