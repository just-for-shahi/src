<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The session keys where the original user id and if busy impersonate
    |--------------------------------------------------------------------------
    */

    'session' => [
        'is_active'     => 'impersonate.is_active',
        'original_user' => 'impersonate.original_user_id',
    ],
];
