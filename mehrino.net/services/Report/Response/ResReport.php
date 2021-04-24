<?php

namespace Services\Report\Response;

use Services\Swagger\CreatedAt;
use Services\Swagger\TraitUser;

/**
 * @OA\Schema(
 *     title="ResReport",
 *     description="ResReport",
 *     type="object"
 * )
 */
class ResReport extends Report
{
    use TraitUser, CreatedAt;
}
