<?php

namespace Services\Abuses\Response;

/**
 * @OA\Schema(
 *     title="ReqStoreAbuses",
 *     description="ReqStoreAbuses",
 *     type="object"
 * )
 */
class ReqStoreAbuses
{
  /**
     * @OA\Property(
     *      title="type",
     *      description="type",
     *      example=1
     * )
     *
     * @var number
     */
    public $type;
}
