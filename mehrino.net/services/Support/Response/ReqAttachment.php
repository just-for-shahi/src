<?php


namespace Services\Support\Response;


/**
 * @OA\Schema(
 *      title="ReqAttachment",
 *      description="ReqAttachment request body data",
 *      type="object",
 *      required={"type","value"}
 * )
 */
class ReqAttachment
{
    /**
     * @OA\Property(
     *      title="type",
     *      description="type",
     *      format="enum",
     *      enum={"image","file"},
     *      example="image"
     * )
     */
    public $type;//string
    /**
     * @OA\Property(
     *      title="value",
     *      description="value",
     *      format="binary"
     * )
     */
    public $value;//string
}
