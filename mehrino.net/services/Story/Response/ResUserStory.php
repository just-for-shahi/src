<?php

namespace Services\Story\Response;

use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="ResStory",
 *     description="ResStory",
 *     type="object"
 * )
 */
class ResUserStory
{
    use UUID;

    /**
     * @OA\Property(
     *      title="name",
     *      description="name"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="avatar",
     *      description="avatar",
     *      example="file"
     * )
     *
     * @var string
     */
    public $avatar;

    /**
     * @OA\Property(
     *      title="ResUser",
     *      format="array",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/Story")
     * )
     */
    public $stories;


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

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function setStories($stories)
    {
        $this->stories = [];
        $model = new Story();
        foreach ($stories as $story) {
            $this->stories[] = $model
                ->setFile($story->file)
                ->setUuid($story->uuid)
                ->setVisit($story->visit)
                ->setIntentId($story->intent_id)
                ->setIntentType($story->intent_type)
                ->toArray();
        }

        return $this;
    }

    public function toArray()
    {
        return [
            "uuid" => $this->uuid,
            "avatar" => $this->avatar,
            "name" => $this->name,
            "stories" => $this->stories
        ];
    }
}
