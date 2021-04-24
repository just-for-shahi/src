<?php

namespace Services\Story\Response;

use Services\Support\Response\ResUser;

/**
 * @OA\Schema(
 *     title="ResShowStory",
 *     description="ResShowStory",
 *     type="object"
 * )
 */
class ResShowStory
{
    /**
     * @OA\Property(
     *      title="value",
     *      description="value",
     *      type="string",
     *      example="0"
     * )
     */
    public $file;

    /**
     * @OA\Property(
     *      title="ResUser",
     *      @OA\Items(ref="#/components/schemas/ResUser")
     * )
     */
    public $visits; //User

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function setVisits($visits)
    {
//        dd($visits);
        $_visits = [];
        foreach ($visits as $visit) {
            $user = $visit->user()->first();
            $model = new ResUser();
            $_visits[] = $model
                ->setAvatar($user->avatar)
                ->setUuid($user->uuid)
                ->setName($user->name)
                ->toArray();
        }
        $this->visits = $_visits;
        return $this;
    }


    public function toArray()
    {
        return [
            "file" => getBaseUri($this->file),
            "visits" => $this->visits,
        ];
    }
}
