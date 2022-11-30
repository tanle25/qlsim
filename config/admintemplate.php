<?php

return [
    'menu'=>[
        [
            'text'=>'dashboard',
            'icon'=>'fal fa-tv',
            'url'=>'admin',
            'role'=>'admin'

        ],

        [
            'text'=>'dashboard',
            'icon'=>'fal fa-tv',
            'url'=>'dealer',
            'role'=>['dealer','collab']
        ],
        // [
        //     'text'=>'config',
        //     'icon'=>'fal fa-cogs',
        //     'role'=>'admin',
        //     'sub'=>[
        //         [
        //             'text'=>'Permissions',
        //             'icon'=>'fal fa-circle',
        //             'active_icon'=>'fad fa-circle',
        //             'url'=>'admin/phan-quyen',
        //             'role'=>'admin'
        //         ],
        //     ]

        // ],

        [
            'text'=>'sim',
            'icon'=>'fal fa-sim-card',
            'sub'=>[
                [
                    'text'=>'list sim',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'admin/danh-sach-sim',
                    'role'=>'admin'
                ],
                [
                    'text'=>'list sim',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'dealer/danh-sach-sim',
                    'role'=>['dealer','collab']
                ],

                // [
                //     'text'=>'pakage',
                //     'icon'=>'fal fa-circle',
                //     'active_icon'=>'fad fa-circle',
                //     'url'=>'dealer/goi-cuoc',
                //     'role'=>['dealer','collab']
                // ],
                // [
                //     'text'=>'pakage',
                //     'icon'=>'fal fa-circle',
                //     'active_icon'=>'fad fa-circle',
                //     'url'=>'admin/goi-cuoc',
                //     'role'=>'admin'
                // ],
                // <i class="fal fa-box-full"></i>
                [
                    'text'=>'request sim',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'admin/danh-sach-sim-yeu-cau',
                    'role'=>'admin'
                ],
                [
                    'text'=>'request sim',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'dealer/yeu-cau-sim',
                    'role'=>['dealer','collab']
                ],
                [
                    'text'=>'network',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'admin/nha-mang-sim',
                    'role'=>'admin'
                ],
            ]
        ],
        [
            'text'=>'dealer & colllab',
            'icon'=>'fal fa-users',
            'url'=>'admin/cong-tac-vien',
            'role'=>'admin'
        ],
        [
            'text'=>'custommers',
            'icon'=>'fal fa-users',
            'url'=>'khach-hang'
        ],
        [
            'text'=>'statis',
            'icon'=>'fal fa-chart-line',
            'url'=>'admin/doanh-thu',
            'role'=>'admin'
        ],
        // [
        //     'text'=>'statis',
        //     'icon'=>'fal fa-chart-line',
        //     'url'=>'dealer/doanh-thu',
        //     'role'=>['dealer','collab']
        // ],
        [
            'text'=>'register wifi',
            'icon'=>'fal fa-router',
            'sub'=>[
                [
                    'text'=>'list',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'danh-sach-yeu-cau',
                ],
                [
                    'text'=>'network',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'admin/nha-mang',
                    'role'=>'admin'
                ],
                [
                    'text'=>'pakage',
                    'icon'=>'fal fa-circle',
                    'active_icon'=>'fad fa-circle',
                    'url'=>'admin/goi-cuoc-wifi',
                    'role'=>'admin'
                ],
            ]
        ],

        ['header'=>'user manager','role'=>['admin','dealer']],

        [
            'text'=>'user',
            'icon'=>'fal fa-user-shield',
            'url'=>'admin/nguoi-dung',
            'role'=>'admin',
        ],
        // [
        //     'text'=>'Staff',
        //     'icon'=>'fal fa-user-shield',
        //     'url'=>'dealer/nhan-vien',
        //     'role'=>'dealer',
        //     'can'=>'user manager'
        // ],
    ],
];
