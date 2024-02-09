<?php

return [
    'fastest_delivery_date' => 1,       // 設定値(1)
    'output_days' => 5,                 // 設定値(2)
    'shipping_deadline' => [            // 設定値(3)
        'deadline_hour' => 8,
        'delay_date' => 1,
        'is_effective' => true
    ],
    'exclude_weekday' => [              // 設定値(4)
        0 => [
            'name' => '日曜日',
            'is_effective' => true,
        ],
        1 => [
            'name' => '月曜日',
            'is_effective' => false,
        ],
        2 => [
            'name' => '火曜日',
            'is_effective' => false,
        ],
        3 => [
            'name' => '水曜日',
            'is_effective' => false,
        ],
        4 => [
            'name' => '木曜日',
            'is_effective' => false,
        ],
        5 => [
            'name' => '金曜日',
            'is_effective' => false,
        ],
        6 => [
            'name' => '土曜日',
            'is_effective' => true,
        ],
    ]
];
