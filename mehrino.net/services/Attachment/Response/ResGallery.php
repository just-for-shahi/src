<?php

namespace Services\Attachment\Response;

/**
 * @OA\Schema(
 *     title="ResGallery",
 *     description="ResGallery",
 *     type="object"
 * )
 */
class ResGallery
{
    /**
     * @OA\Property(
     *      title="uuid",
     *      description="uuid",
     *      example="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
     * )
     *
     * @var string
     */
    public $uuid;


   /**
     * @OA\Property(
     *      title="path",
     *      description="path",
     *      example="https://s.mehrino.net/test.png"
     * )
     *
     * @var string
     */
    public $path; //String
}
