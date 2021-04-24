<?php

return [
    'version' => '0.1.0',
    'credit.captain' => 5000,
    'credit.join' => 10000,
    'datetime' => 'Y/m/d H:i:s.u',
    'date' => 'Y/m/d',
    'wc_url' => 'https://hirbodapp.ir',
    'wc_ck' => 'ck_950597acea8c12c8bd638b7a5a22dc4c7df667fe',
    'wc_cs' => 'cs_5927dc884c9360419bcaa2f8f8e9d552fe38ae53',
    'sms' => [
        'key' => '7935396C76394376347369654B434E5233346C626B2B5A6E64366C337A434B49',
    ],
    'payir' => [
        'key' => 'ec77aa470eb23e85855af77d194a7375',
        'url' => 'https://pay.ir/pg/',
        'gateway'=>'b3a52bf4-b3d5-4bca-8338-643cd9d1704f'
    ],
    'uinvest' => [
        'key' => 'ee6a58b0-5065-4a1c-8bde-7b657cfd995a',
        'url' => 'https://uinvest.ir/pay/pg/',
        'gateway'=>'b3a52bf4-b3d5-4bca-8338-643cd9d1704f'
    ],
    'azarpay' => [
        'key' => '',
        'url' => '',
        'gateway' => ''
    ],
    'zp' => [
        'gateway' => '32a5ed39-78de-4a29-bd0b-cfa8a32d5adf',
        'url' => 'https://www.zarinpal.com/pg/',
        'callbackUrl' => env('CALLBACK_URL')
    ],
    'google' => [
        'site_key' => env('GOOGLE_RECAPTCHA_SITE_KEY'),
        'secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY')
    ],
    'currency' => 'IRT',
    'disk' => 'public',
    'sara' => 'https://s.hirbod.ac/hirbod/',
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
    //'secret' => '-^@6yR2Dx^=aDtTQ%crTT_ReTv?Bp3Gxm6eUy93L?tqJEjRjR&_uy_F+P9s7kwUPgft!-=Ey@7=D^p9QcU_LB^mct!!cW5Sf$nJCYd@sxmYgMc2LWEsEJ47Q!^8!zKzr%27+T=rwNtaXYWumjxHf*7Af$NGXS44Y?@u%!QedHv6@T&$S$tptYndM^G=zxQu^HSJHn+kw2BSaD?pgAFTaVtQPq3G?LhjnMr3fXqUFP-mvLA6**Je^K3PQP+Jt3eQ&',
    'secret' => 'milad',
];
