<?php


namespace Services\Support\Response;

/**
 * @OA\Schema(
 *     title="ResFaq",
 *     description="ResFaq",
 *     @OA\Xml(
 *         name="ResFaq"
 *     )
 * )
 */
class ResFaq
{
    /**
     * @OA\Property(
     *      title="uuid",
     *      description="it is uuid",
     *      example="XXXX-...-XXXX"
     * )
     *
     * @var string
     */
    public $uuid;
    /**
     * @OA\Property(
     *      title="parent",
     *      description="it is uuid",
     *      example="XXXX-...-XXXX"
     * )
     *
     * @var string
     */
    public $parent;

    /**
     * @OA\Property(
     *      title="question",
     *      description="value of the question",
     *      example="question"
     * )
     *
     * @var string
     */
    public $question; //String
    /**
     * @OA\Property(
     *      title="answer",
     *      description="value of the answer",
     *      example="answer"
     * )
     *
     * @var string
     */
    public $answer; //String
}
