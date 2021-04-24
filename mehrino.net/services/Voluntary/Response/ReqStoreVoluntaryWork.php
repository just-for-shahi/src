<?php

namespace Services\Voluntary\Response;

/**
 * @OA\Schema(
 *     title="ReqStoreVoluntaryWork",
 *     description="ReqStoreVoluntaryWork",
 *     type="object"
 * )
 */
class ReqStoreVoluntaryWork
{
    /**
     * @OA\Property(
     *      title="institutes",
     *      description="institutes",
     *      format="UUID",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $institutes;

    /**
     * @OA\Property(
     *      title="title",
     *      description="title string",
     *      example="Hello world!"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="activity",
     *      description="activity",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $activity;

    /**
     * @OA\Property(
     *      title="audience",
     *      description="audience",
     *      example="test"
     * )
     *
     * @var string
     */
    public $audience;

    /**
     * @OA\Property(
     *      title="period",
     *      description="period",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $period;

    /**
     * @OA\Property(
     *      title="language",
     *      description="language",
     *      example="farsi"
     * )
     *
     * @var string
     */
    public $language;

    /**
     * @OA\Property(
     *      title="location",
     *      description="location",
     *      example="0"
     * )
     *
     * @var string
     */
    public $location;

    /**
     * @OA\Property(
     *      title="latitude",
     *      description="latitude of coordination",
     *      example="32.4279"
     * )
     *
     * @var string
     */
    public $latitude;

    /**
     * @OA\Property(
     *      title="longitude",
     *      description="longitude of coordination",
     *      example="53.6880"
     * )
     *
     * @var string
     */
    public $longitude;

    /**
     * @OA\Property(
     *      title="address",
     *      description="address",
     *      example="0"
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *      title="capacity",
     *      description="capacity",
     *      example="0"
     * )
     *
     * @var integer
     */
    public $capacity;

    /**
     * @OA\Property(
     *      title="description",
     *      description="description",
     *      example="Hello world"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="date",
     *      description="date",
     *      format="date-time",
     *      example="2020-12-24"
     * )
     *
     * @var string
     */
    public $date;

    /**
     * @OA\Property(
     *     description="Item image",
     *     property="galleries[]",
     *     type="array",
     *     @OA\Items(type="string", format="uuid")
     *)
     */
    public $galleries;

    /**
     * @OA\Property(
     *     description="Cover image",
     *     property="cover",
     *     type="file",
     *     format="binary"
     *)
     */
    public $cover;
}
