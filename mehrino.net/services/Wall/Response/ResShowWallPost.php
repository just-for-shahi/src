<?php

namespace Services\Wall\Response;

use Services\Swagger\Galleries;

/**
 * @OA\Schema(
 *     title="ResShowWall",
 *     description="ResShowWallPost",
 *     type="object"
 * )
 */
class ResShowWallPost extends WallPost
{
    use Galleries;
}
