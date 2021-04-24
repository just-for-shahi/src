<?php


namespace Services\Institute\Response;

/**
 * @OA\Schema(
 *     title="Institute",
 *     description="Institute",
 *     type="object"
 * )
 */
class Institute extends Social
{

    /**
     * @OA\Property(
     *      title="uuid",
     *      description="uuid",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $uuid; //String

    /**
     * @OA\Property(
     *      title="ResUser",
     *      ref="#/components/schemas/ResUser"
     * )
     */
    public $user; //User

    /**
     * @OA\Property(
     *      title="title",
     *      description="title",
     *      example="title"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="type",
     *      description="type",
     *      format="enum",
     *      enum={"type1", "type2", "type3"},
     *      example="type1"
     * )
     * @var string
     */
    public $type;
    /**
     * @OA\Property(
     *      title="logo",
     *      description="logo",
     *      type="file",
     *      format="binary"
     * )
     */
    public $logo;


    /**
     * @OA\Property(
     *      title="email",
     *      description="email",
     *      example="email"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="phone",
     *      description="phone",
     *      example="phone"
     * )
     *
     * @var string
     */
    public $phone;
    /**
     * @OA\Property(
     *      title="registered",
     *      description="registered",
     *      example="registered"
     * )
     *
     * @var string
     */
    public $registered;

    /**
     * @OA\Property(
     *      title="registered_no",
     *      description="registered_no",
     *      example="registered_no"
     * )
     *
     * @var string
     */
    public $registered_no;
    /**
     * @OA\Property(
     *      title="registered_name",
     *      description="registered_name",
     *      example="registered_name"
     * )
     *
     * @var string
     */
    public $registered_name;
    /**
     * @OA\Property(
     *      title="license_no",
     *      description="license_no",
     *      example="license_no"
     * )
     *
     * @var string
     */
    public $license_no;
    /**
     * @OA\Property(
     *      title="license_expir",
     *      description="license_expir",
     *      format="date-time",
     *      example="2020-12-24 10:03:07"
     * )
     *
     * @var string
     */
    public $license_expire;
    /**
     * @OA\Property(
     *      title="license_provider",
     *      description="license_provider",
     *      example="0"
     * )
     *
     * @var number
     */
    public $license_provider;
    /**
     * @OA\Property(
     *      title="address",
     *      description="address",
     *      example="address"
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *      title="activity_range",
     *      description="activity_range",
     *      example="100"
     * )
     *
     * @var number
     */
    public $activity_range;
    /**
     * @OA\Property(
     *      title="ceo",
     *      description="ceo",
     *      example="sajjad moghammadi"
     * )
     *
     * @var string
     */
    public $ceo;
    /**
     * @OA\Property(
     *      title="license_file",
     *      description="license_file",
     *      type="file",
     *      format="binary"
     * )
     */
    public $license_file;
    /**
     * @OA\Property(
     *      title="statute_file",
     *      description="statute_file",
     *      type="file",
     *      format="binary"
     * )
     */
    public $statute_file;

    /**
     * @OA\Property(
     *      title="latitude",
     *      description="latitude",
     *      example="23.23"
     * )
     *
     * @var number
     */
    public $latitude;
    /**
     * @OA\Property(
     *      title="longitude",
     *      description="longitude",
     *      example="23.23"
     * )
     *
     * @var number
     */
    public $longitude;
    /**
     * @OA\Property(
     *      title="covered_persons",
     *      description="covered_persons",
     *      example="0"
     * )
     *
     * @var number
     */
    public $covered_persons;

    /**
     * @OA\Property(
     *      title="about",
     *      description="about",
     *      example="about"
     * )
     *
     * @var string
     */
    public $about;

    /**
     * @OA\Property(
     *      title="InstituteBranch",
     *      description="InstituteBranch",
     *      type="array",
     *     @OA\Items(ref="#/components/schemas/InstituteBranch")
     * )
     */
    public $branch;
    /**
     * @OA\Property(
     *      title="work_hours",
     *      description="work_hours",
     *     ref="#/components/schemas/InstituteWorkHours"
     * )
     */
    public $work_hours;
    /**
     * @OA\Property(
     *      title="board_member",
     *      description="board_member",
     *      type="array",
     *     @OA\Items(ref="#/components/schemas/InstituteBoardMember")
     * )
     */
    public $board_member;
}
