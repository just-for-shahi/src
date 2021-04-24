<?php


namespace Services\User\Response;

/**
 * @OA\Schema(
 *      title="UserSign",
 *      description="UserSign request body data",
 *      type="object",
 *      required={"type","value"}
 * )
 */
class UserSign
{
    /**
     * @OA\Property(
     *      title="type",
     *      description="type of the mobile or email or username",
     *      example="mobile"
     * )
     *
     * @var string
     */
    public $type;
    /**
     * @OA\Property(
     *      title="value",
     *      description="value of the mobile or email",
     *      example="989332369461"
     * )
     *
     * @var string
     */
    public $value; //String
    /**
     * @OA\Property(
     *      title="type",
     *      description="type of the mobile or email or username"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="captain",
     *      description="captain"
     * )
     *
     * @var string
     */
    public $captain;
}
