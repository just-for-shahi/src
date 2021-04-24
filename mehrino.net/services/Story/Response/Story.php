<?php

namespace Services\Story\Response;

use Services\Swagger\UUID;

/**
 * @OA\Schema(
 *     title="Story",
 *     description="Story",
 *     type="object"
 * )
 */
class Story
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
    public $visit;
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
        $this->file = getBaseUri($file);
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
    public function setIntentType($intent_type): Story
    {
        $this->intent_type = $intent_type;
        return $this;
    }

    /**
     * @param number $intent_id
     * @return Story
     */
    public function setIntentId($intent_id): Story
    {
        $this->intent_id = $intent_id;
        return $this;
    }

    public function toArray()
    {
        return [
            "uuid" => $this->uuid,
            "visit" => $this->visit,
            "file" => $this->file,
            "intent_id" => $this->intent_id,
            "intent_type" => $this->intent_type,
        ];
    }
}
