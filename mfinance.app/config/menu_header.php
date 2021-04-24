<?php
// Header menu
return [

    'items' => [
        [],
        [
            'title' => 'Dashboard',
            'root' => true,
            'page' => '/',
            'new-tab' => false,
        ],
//        [
//            'title' => 'Admin',
//            'root' => true,
//            'toggle' => 'hover',
//            'submenu' => [
//                'type' => 'classic',
//                'alignment' => 'left',
//                'items' => [
//                    [
//                        'title' => 'Accounts',
//                        'bullet' => 'dot',
//                        'icon' => 'media/svg/icons/Communication/Address-card.svg',
//                        'submenu' => [
//                            [
//                                'title' => 'List - Default',
//                                'page' => 'custom/apps/user/list-default'
//                            ],
//                            [
//                                'title' => 'List - Datatable',
//                                'page' => 'custom/apps/user/list-datatable'
//                            ],
//                            [
//                                'title' => 'List - Columns 1',
//                                'page' => 'custom/apps/user/list-columns-1'
//                            ],
//                            [
//                                'title' => 'List - Columns 2',
//                                'page' => 'custom/apps/user/list-columns-2'
//                            ],
//                            [
//                                'title' => 'Add User',
//                                'page' => 'custom/apps/user/add-user'
//                            ],
//                            [
//                                'title' => 'Edit User',
//                                'page' => 'custom/apps/user/edit-user'
//                            ]
//                        ]
//                    ],
//                    [
//                        'title' => 'Contacts',
//                        'bullet' => 'dot',
//                        'icon' => 'media/svg/icons/Communication/Adress-book1.svg',
//                        'submenu' => [
//                            [
//                                'title' => 'List - Columns',
//                                'page' => 'custom/apps/contacts/list-columns'
//                            ],
//                            [
//                                'title' => 'List - Datatable',
//                                'page' => 'custom/apps/contacts/list-datatable'
//                            ],
//                            [
//                                'title' => 'View Contact',
//                                'page' => 'custom/apps/contacts/view-contact'
//                            ],
//                            [
//                                'title' => 'Add Contact',
//                                'page' => 'custom/apps/contacts/add-contact'
//                            ],
//                            [
//                                'title' => 'Edit Contact',
//                                'page' => 'custom/apps/contacts/edit-cotact'
//                            ]
//                        ]
//                    ],
//                    [
//                        'title' => 'Emails',
//                        'bullet' => 'dot',
//                        'icon' => 'media/svg/icons/Communication/Mail-opened.svg',
//                        'submenu' => [
//                            [
//                                'title' => 'Private',
//                                'page' => 'custom/apps/chat/private'
//                            ],
//                            [
//                                'title' => 'Group',
//                                'page' => 'custom/apps/chat/group'
//                            ],
//                            [
//                                'title' => 'Popup',
//                                'page' => 'custom/apps/chat/popup'
//                            ]
//                        ]
//                    ],
//                    [
//                        'title' => 'Branches',
//                        'bullet' => 'dot',
//                        'icon' => 'media/svg/icons/Shopping/Box2.svg',
//                        'submenu' => [
//                            [
//                                'title' => 'List - Columns 1',
//                                'page' => 'custom/apps/projects/list-columns-1'
//                            ],
//                            [
//                                'title' => 'List - Columns 2',
//                                'page' => 'custom/apps/projects/list-columns-2'
//                            ],
//                            [
//                                'title' => 'List - Columns 3',
//                                'page' => 'custom/apps/projects/list-columns-3'
//                            ],
//                            [
//                                'title' => 'List - Columns 4',
//                                'page' => 'custom/apps/projects/list-columns-4'
//                            ],
//                            [
//                                'title' => 'List - Datatable',
//                                'page' => 'custom/apps/projects/list-datatable'
//                            ],
//                            [
//                                'title' => 'View Project',
//                                'page' => 'custom/apps/projects/view-project'
//                            ],
//                            [
//                                'title' => 'Add Project',
//                                'page' => 'custom/apps/projects/add-project'
//                            ],
//                            [
//                                'title' => 'Edit Project',
//                                'page' => 'custom/apps/projects/edit-project'
//                            ]
//                        ]
//                    ],
//                    [
//                        'title' => 'Support Center',
//                        'bullet' => 'dot',
//                        'icon' => 'media/svg/icons/General/Shield-check.svg',
//                        'submenu' => [
//                            [
//                                'title' => 'Home 1',
//                                'page' => 'custom/apps/support-center/home-1'
//                            ],
//                            [
//                                'title' => 'Home 2',
//                                'page' => 'custom/apps/support-center/home-2'
//                            ],
//                            [
//                                'title' => 'FAQ 1',
//                                'page' => 'custom/apps/support-center/faq-1'
//                            ],
//                            [
//                                'title' => 'FAQ 2',
//                                'page' => 'custom/apps/support-center/faq-2'
//                            ],
//                            [
//                                'title' => 'FAQ 3',
//                                'page' => 'custom/apps/support-center/faq-3'
//                            ],
//                            [
//                                'title' => 'Feedback',
//                                'page' => 'custom/apps/support-center/feedback'
//                            ],
//                            [
//                                'title' => 'License',
//                                'page' => 'custom/apps/support-center/license'
//                            ]
//                        ]
//                    ],
//
//                    [
//                        'title' => 'Contracts',
//                        'bullet' => 'dot',
//                        'icon' => 'media/svg/icons/Communication/Clipboard-list.svg',
//                        'submenu' => [
//                            [
//                                'title' => 'Tasks',
//                                'page' => 'custom/apps/todo/tasks'
//                            ],
//                            [
//                                'title' => 'Docs',
//                                'page' => 'custom/apps/todo/docs'
//                            ],
//                            [
//                                'title' => 'Files',
//                                'page' => 'custom/apps/todo/files'
//                            ]
//                        ]
//                    ],
//
//                    [
//                        'title' => 'Security',
//                        'bullet' => 'dot',
//                        'label' => [
//                            'type' => 'label-danger label-inline',
//                            'value' => 'new'
//                        ],
//                        'icon' => 'media/svg/icons/General/Shield-check.svg',
//                        'page' => 'custom/apps/inbox'
//                    ]
//                ]
//            ]
//        ],
    ]

];
