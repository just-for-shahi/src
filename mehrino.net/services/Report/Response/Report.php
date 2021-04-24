<?php

namespace Services\Report\Response;

use Services\Swagger\Content;
use Services\Swagger\Title;

/**
 * @OA\Schema(
 *     title="Report",
 *     description="Report",
 *     type="object"
 * )
 */
class Report
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
