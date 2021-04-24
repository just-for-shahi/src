<?php


namespace Services\Institute\Response;

/**
 * @OA\Schema(
 *     title="InstituteWorkHours",
 *     description="InstituteWorkHours",
 *     type="object"
 * )
 */
class InstituteWorkHours
{
    /**
     * @OA\Property(
     *      title="saturday_start",
     *      description="saturday_start",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $saturday_start;
    /**
     * @OA\Property(
     *      title="saturday_end",
     *      description="saturday_end",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $saturday_end;
    /**
     * @OA\Property(
     *      title="sunday_start",
     *      description="sunday_start",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $sunday_start;
    /**
     * @OA\Property(
     *      title="sunday_end",
     *      description="sunday_end",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $sunday_end;
    /**
     * @OA\Property(
     *      title="monday_start",
     *      description="monday_start",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $monday_start;
    /**
     * @OA\Property(
     *      title="monday_end",
     *      description="monday_end",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $monday_end;
    /**
     * @OA\Property(
     *      title="tuesday_start",
     *      description="tuesday_start",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $tuesday_start;
    /**
     * @OA\Property(
     *      title="tuesday_end",
     *      description="tuesday_end",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $tuesday_end;
    /**
     * @OA\Property(
     *      title="wednesday_start",
     *      description="wednesday_start",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $wednesday_start;
    /**
     * @OA\Property(
     *      title="wednesday_end",
     *      description="wednesday_end",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $wednesday_end;
    /**
     * @OA\Property(
     *      title="thursday_start;",
     *      description="thursday_start",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $thursday_start;
    /**
     * @OA\Property(
     *      title="thursday_end",
     *      description="thursday_end",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $thursday_end;
    /**
     * @OA\Property(
     *      title="friday_start",
     *      description="friday_start",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $friday_start;
    /**
     * @OA\Property(
     *      title="friday_end",
     *      description="friday_end",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $friday_end;
}
