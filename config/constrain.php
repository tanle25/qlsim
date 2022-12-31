<?php
return[
    'partner'=>[
        0=>'dealer',
        1=>'colllab'
    ],
    'sim_status'=>[
        0=>[
            'text'=>'stop',
            'color'=>'text-red-500'
        ],
        1=>[
            'text'=>'active',
            'color'=>'text-green-500'
        ],
        2=>[
            // 'text'=>'rent',
            'text'=>'active',
            'color'=>'text-green-500'
        ],
        3=>[
            'text'=>'temporarily cut',
            'color'=>'text-red-500'
        ],
        4=>[
            'text'=>'Cancel',
            'color'=>'text-red-500'
        ],
        5=>[
            'text'=>'refreshing',
            'color'=>'text-yellow-500'
        ],

    ],
    'pakage'=>[
        1=>[
            'value'=>1,
            'text'=>'1 month'
        ],
        2=>[
            'value'=>6,
            'text'=>'6 month'
        ],
        3=>[
            'value'=>12,
            'text'=>'1 year'
        ],
    ],
    'wifi_request'=>[
        0=>'new',
        1=>'Done'
    ],
    'owner'=>[
        1=>'owner',
        2=>'member'
    ],
    'invoice'=>[
        1=>'rent sim',
        2=>'Extend sim',
        3=>'Wifi installation'
    ],
    'request'=>[
        0=>'no process',
        1=>'Done',
        2=>'refuse'
    ],

    'action'=>[
        0=>'Thêm sim',
        1=>'Sửa sim',
        3=>'Xoá',
        4=>'Cho thuê',
        5=>'Gia hạn',
        6=>'Huỷ',
        7=>'Tạm cắt',
        8=>'Mở',
        9=>'Làm mới'
    ]

];
