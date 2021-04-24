<?php

namespace Services\Story\Response;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="ReqStoreStory",
 *     description="ReqStoreStory",
 *     type="object"
 * )
 */
class ReqStoreStory
{


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
     *      example=""
     * )
     *
     * @var string
     */
    public $intent_id;

    /**
     * @OA\Property(
     *      title="value",
     *      description="value",
     *      type="file",
     *      format="binary"
     * )
     */
    public $file;

    public function __construct(Request $request)
    {
        $this->intent_type = $request->input('intent_type', 0);
        $this->intent_id = $request->input('intent_id', 0);
        $this->file = $request->file('file')->store(uploadPath('/store'));
    }

    public function toArray()
    {
        return [
            "user" => auth()->id(),
            "intent_type" => $this->intent_type ?? 0,
            "intent_id" => $this->intent_id ?? 0,
            "file" => $this->file,
        ];
    }
}
