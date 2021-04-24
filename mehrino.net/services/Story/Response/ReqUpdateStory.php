<?php

namespace Services\Story\Response;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ReqUpdateStory",
 *     description="ReqUpdateStory",
 *     type="object"
 * )
 */
class ReqUpdateStory
{
    /**
     * @OA\Property(
     *      title="file",
     *      description="file",
     *      type="file",
     *      format="binary"
     * )
     */
    public $file;

    public function __construct(Request $request)
    {

        $this->file = $request->file('file')->store(uploadPath('/store'));
    }

    public function toArray()
    {
        return [
            "file" => $this->file,
        ];
    }
}
