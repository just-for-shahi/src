<?php
/**
 * Created by PhpStorm.
 * User: amir7
 * Date: 2018-11-17
 * Time: 2:17 AM
 */

namespace App\Scripts\Helpers;


/**
 * Class SessionHelper
 * @package App\Scripts\Helpers
 */
class SessionHelper
{
    public const SUCCESS = 'SUCCESS';
    public const CREATED = 'CREATED';
    public const UPDATED = 'UPDATED';
    public const DELETED = 'DESTROYED';
    public const MESSAGE = 'MESSAGE';
    public const SUBMITTED = 'SUBMITTED';

    /**
     * @param string $type
     * @param null $message
     */
    public static function flash($type = 'CREATED', $message = null)
    {
        $messages = [
            'SUCCESS' => trans('messages.success'),
            'CREATED' => trans('messages.created'),
            'UPDATED' => trans('messages.updated'),
            'DELETED' => trans('messages.destroyed'),
            'SUBMITTED' => trans('messages.submitted'),
        ];

        $type = strtoupper($type);
        if ($type != 'MESSAGE') {
            $message = $messages[$type];
        }

        session()->flash('message', $message);
    }
}
