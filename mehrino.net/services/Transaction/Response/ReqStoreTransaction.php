<?php

namespace Services\Transaction\Response;

/**
 * @OA\Schema(
 *     title="ReqStoreTransaction",
 *     description="ReqStoreTransaction",
 *     type="object"
 * )
 */
class ReqStoreTransaction
{
    /**
     * @OA\Property(
     *      title="amount",
     *      description="at least 100",
     *      example="100"
     * )
     *
     * @var integer
     */
    public $amount;

    /**
     * @OA\Property(
     *      title="use_wallet",
     *      description="only for type = 1",
     *      example=false
     * )
     *
     * @var bool
     */
    public $use_wallet;
}
