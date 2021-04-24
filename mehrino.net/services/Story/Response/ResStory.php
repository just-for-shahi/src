<?php

namespace Services\Story\Response;

use Services\Support\Response\ResUser;
use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResStory",
 *     description="ResStory",
 *     type="object"
 * )
 */
class ResStory
{
    use UUID;

    /**
     * @OA\Property(
     *      title="intent_type",
     *      description="intent_type choice from list [0 =>general, 1 => project, 2=> wall, 3 =>Voluntary]",
     *      example="0"
     * )
     *
     * @var number
     */
    public $intent_type;

    /**
     * @OA\Property(
     *      title="intent_id",
     *      description="it is the UUID from  null,project,wall,voluntary",
     *      example="null"
     * )
     *
     * @var string
     */
    public $intent_id;
    /**
     * @OA\Property(
     *      title="visit",
     *      description="visit",
     *      type="boolean",
     *      example="false"
     * )
     */
    public $visit; //$visit
    /**
     * @OA\Property(
     *      title="ResUser",
     *      ref="#/components/schemas/ResUser"
     * )
     */
    public $user; //User
    /**
     * @OA\Property(
     *      title="value",
     *      description="value",
     *      type="string",
     *      example="0"
     * )
     */
    public $file;

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }


    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }


    public function setVisit($visit)
    {
        $this->visit = !(!$visit ?? true);
        return $this;
    }

    /**
     * @param number $intent_type
     * @return Story
     */
    public function setIntentType($intent_type)
    {
        $this->intent_type = $intent_type;
        return $this;
    }

    /**
     * @param number $intent_id
     * @return Story
     */
    public function setIntentId($intent_id)
    {
        $this->intent_id = $intent_id;
        return $this;
    }

    public function setUser($user)
    {
        $model = new ResUser();
        $this->user = $model
            ->setAvatar($user->avatar)
            ->setUuid($user->uuid)
            ->setName($user->name)
            ->toArray();
        return $this;
    }

    public function toArray()
    {
        return [
            "uuid" => $this->uuid,
            "intent_type" => $this->intent_type,
            "intent_id" => $this->intent_id,
            "user" => $this->user,
            "visit" => $this->visit,
            "file" => getBaseUri($this->file),
        ];
    }
}
