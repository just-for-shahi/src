<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/dashboard',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'Services',
        ],
        [
            'title' => 'Investments',
            'page' => 'investments',
            'icon' => 'media/svg/icons/Communication/Clipboard-check.svg',
        ],
        [
            'title' => 'Signals',
            'page' => 'signals',
            'icon' => 'media/svg/icons/Navigation/Up-down.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Analyzers',
                    'page' => 'signals/analyzers',
                ],
                [
                    'title' => 'Subscriptions',
                    'page' => 'signals/subscriptions',
                ],
            ]
        ],
        [
            'title' => 'MAccounts',
            'page' => 'maccounts',
            'icon' => 'media/svg/icons/Shopping/Sale1.svg',
        ],

        [
            'section' => 'Finance'
        ],

        [
            'title' => 'Transactions',
            'page' => 'transactions',
            'icon' => 'media/svg/icons/Shopping/Money.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'transactions'
                ],
                [
                    'title' => 'Deposit',
                    'page' => 'transactions/deposit'
                ],
//                [
//                    'title' => 'Transfer',
//                    'page' => 'transactions/transfer'
//                ], //@TODO: Add this method to finance module
            ]
        ],

        [
            'title' => 'Wallets',
            'page' => 'wallets',
            'icon' => 'media/svg/icons/Shopping/Bitcoin.svg',
        ],

        [
            'title' => 'Withdraws',
            'page' => 'withdraws',
            'icon' => 'media/svg/icons/Communication/Outgoing-box.svg',
        ],

        [
            'section'  => 'Support'
        ],

        [
            'title' => 'Tickets',
            'page' => 'tickets',
            'icon'  => 'media/svg/icons/General/Smile.svg',
        ],

        [
            'title' => 'Call Requests',
            'page' => 'call-requests',
            'icon'  => 'media/svg/icons/Communication/Active-call.svg',
        ],

        [
            'title' => 'FAQs',
            'page' => 'faqs',
            'icon'  => 'media/svg/icons/Code/Info-circle.svg',
        ],

    ]
];
