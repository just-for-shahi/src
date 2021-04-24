<?php


namespace Services\Institute\Response;


class Social
{
    /**
     * @OA\Property(
     *      title="linkedin",
     *      description="linkedin",
     *      example="sajadweb.linkedin.com"
     * )
     *
     * @var string
     */
    public $linkedin;
    /**
     * @OA\Property(
     *      title="youtube",
     *      description="youtube",
     *      example="sajadweb.youtube.com"
     * )
     *
     * @var string
     */
    public $youtube;
    /**
     * @OA\Property(
     *      title="instagram",
     *      description="instagram",
     *      example="sajadweb.instagram.com"
     * )
     *
     * @var string
     */
    public $instagram;
    /**
     * @OA\Property(
     *      title="telegram",
     *      description="telegram",
     *      example="sajadweb.telegram.com"
     * )
     *
     * @var string
     */
    public $telegram;
    /**
     * @OA\Property(
     *      title="aparat",
     *      description="aparat",
     *      example="sajadweb.aparat.com"
     * )
     *
     * @var string
     */
    public $aparat;
    /**
     * @OA\Property(
     *      title="whatsapp",
     *      description="whatsapp",
     *      example="sajadweb.whatsapp.com"
     * )
     *
     * @var string
     */
    public $whatsapp;

    /**
     * @OA\Property(
     *      title="website",
     *      description="website",
     *      example="ajadweb.website.com"
     * )
     *
     * @var string
     */
    public $website;
}
