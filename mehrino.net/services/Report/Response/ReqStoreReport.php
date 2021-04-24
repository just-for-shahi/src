<?php

namespace Services\Report\Response;

use Services\Swagger\Content;
use Services\Swagger\Title;

/**
 * @OA\Schema(
 *     title="ReqStoreReport",
 *     description="ReqStoreReport",
 *     type="object"
 * )
 */
class ReqStoreReport
{
    use Title, Content;
    /**
     * @OA\Property(
     *      title="cover",
     *      description="cover",
     *      type="file",
     *      format="binary"
     * )
     */
    public $cover;
    /**
     * @OA\Property(
     *     description="Item image and pdf and ...",
     *     property="galleries[]",
     *     type="array",
     *     @OA\Items(type="file", format="binary")
     *)
     */
    public $galleries;
}
