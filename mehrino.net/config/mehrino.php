<?php

return [
    'version' => '0.1.0',
    'credit.captain' => 5000,
    'credit.join' => 10000,
    'datetime' => 'Y/m/d H:i:s.u',
    'date' => 'Y/m/d',
    'sms' => [
        'key' => '7935396C76394376347369654B434E5233346C626B2B5A6E64366C337A434B49',
    ],
    'payir' => [
        'key' => 'ec77aa470eb23e85855af77d194a7375',
        'url' => 'https://pay.ir/pg/',
        'gateway' => 'b3a52bf4-b3d5-4bca-8338-643cd9d1704f'
    ],
    'uinvest' => [
        'key' => 'ee6a58b0-5065-4a1c-8bde-7b657cfd995a',
        'url' => 'https://uinvest.ir/pay/pg/',
        'gateway' => 'b3a52bf4-b3d5-4bca-8338-643cd9d1704f'
    ],
    'azarpay' => [
        'key' => '',
        'url' => '',
        'gateway' => ''
    ],
    'zp' => [
        'gateway' => '31ee758a-8155-4409-96a9-c66f1cb3cac8',
        'url' => 'https://www.zarinpal.com/pg/',
        'callbackUrl' =>  env('CALLBACK_URL')
    ],
    'currency' => 'IRT',
    'disk' => 'public',
    'sara' => 'https://s.mehrino.net/mehrino/',
    'temporary' => [
        'account' => [
            'superAdmin' => 30,
            'admin' => 15,
            'owner' => 15,
            'user' => 5,
        ],
        'ebooks' => [
            'superAdmin' => 30,
            'admin' => 15,
            'owner' => 15,
            'user' => 5,
        ],
        'podcasts' => [
            'superAdmin' => 30,
            'admin' => 15,
            'owner' => 15,
            'user' => 5,
        ]
    ],
    'secret' => 'secret',
    'upload' => [
        'path' => 'path'
    ],
    'default_status' => [
        'store' => 1,
        'show' => 1
    ]
];
