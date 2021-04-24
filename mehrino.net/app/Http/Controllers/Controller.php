<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="MehriNo Swagger UI",
     *      description="Swagger OpenApi v1",
     *      @OA\Contact(
     *          email="sajadweb7@gmail.com"
     *      ),
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
     */

    /**
     *  @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Localhost host server"
     *  )
     *
     */

    /**
     * @OA\SecurityScheme(
     *     securityScheme="bearerAuth",
     *     type="http",
     *     scheme="bearer",
     *     name="Authorization",
     *     in="header"
     * )
     *
     * @OA\Header(
     *   header="x-page",
     *   description="current page",
     *   @OA\Schema( type="integer" )
     * )
     *
     * @OA\Header(
     *   header="x-count",
     *   description="total items in each page",
     *   @OA\Schema( type="integer" )
     * )
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
