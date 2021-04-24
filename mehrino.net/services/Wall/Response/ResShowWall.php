<?php

namespace Services\Wall\Response;

use Services\Swagger\Galleries;

/**
 * @OA\Schema(
 *     title="ResShowWall",
 *     description="ResShowWall",
 *     type="object"
 * )
 */
class ResShowWall  extends Wall
{
use Galleries;
}
