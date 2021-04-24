<?php

namespace Services\Project\Response;

/**
 * @OA\Schema(
 *     title="ReqUpdateProject",
 *     description="ReqUpdateProject",
 *     type="object"
 * )
 */
class ReqUpdateProject extends ReqStoreProject
{
    /**
     * @OA\Property(
     *      title="institutes",
     *      deprecated=true,
     *      description="institutes",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $institutes;
}
