<?php


namespace Services\Support\Response;

/**
 * @OA\Schema(
 *     title="ResUser",
 *     description="ResUser",
 * )
 */
class ResUser
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
     *      title="name",
     *      description="name",
     *      example="name"
     * )
     *
     * @var string
     */
    public $name; //String
    /**
     * @OA\Property(
     *      title="avatar",
     *      description="avatar",
     *      example="avatar.png"
     * )
     *
     * @var string
     */
    public $avatar;


    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }


    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = getBaseUri($avatar);
        return $this;
    }


    public function toArray()
    {
        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "avatar" => $this->avatar,
        ];
    }
}
