<?php

namespace Services\Transaction\Response;

use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResTransaction",
 *     description="ResTransaction",
 *     type="object"
 * )
 */
class ResTransaction
{

    use UUID;

    /**
     * @OA\Property(
     *      title="amount",
     *      description="amount",
     *      example="4000"
     * )
     *
     * @var number
     */
    public $amount;

    /**
     * @OA\Property(
     *      title="description",
     *      description="description",
     *      example="description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="authority",
     *      description="authority",
     *      example="099ab02a2484cf1e"
     * )
     *
     * @var string
     */
    public $authority;
    /**
     * @OA\Property(
     *      title="cardNumber",
     *      description="cardNumber",
     *      example="099a-43f7-8eb3-b9aa"
     * )
     *
     * @var string
     */
    public $cardNumber;
    /**
     * @OA\Property(
     *      title="traceNumber",
     *      description="traceNumber",
     *      example="099ab02f1e"
     * )
     *
     * @var string
     */
    public $traceNumber;
    /**
     * @OA\Property(
     *      title="status",
     *      description="status",
     *      example="1"
     * )
     *
     * @var number
     */
    public $status;
    /**
     * @OA\Property(
     *      title="createdAt",
     *      description="createdAt",
     *      example="2020-12-12 14:30:20+3:30"
     * )
     *
     * @var string
     */
    public $createdAt;
    /**
     * @OA\Property(
     *      title="updatedAt",
     *      description="updatedAt",
     *      example="2020-12-12 14:30:20+3:30"
     * )
     *
     * @var string
     */
    public $updatedAt;

    /**
     * @param number $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $authority
     */
    public function setAuthority($authority)
    {
        $this->authority = $authority;
        return $this;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @param string $traceNumber
     */
    public function setTraceNumber($traceNumber)
    {
        $this->traceNumber = $traceNumber;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function toArray()
    {
        return [
            "uuid" => $this->uuid,
            "amount" => $this->amount,
            "description" => $this->description,
            "authority" => $this->authority,
            "cardNumber" => $this->cardNumber,
            "traceNumber" => $this->traceNumber,
            "status" => $this->status,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt
        ];
    }
}
