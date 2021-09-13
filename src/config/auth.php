<?php

return [
    'guards' => [
    
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],
    
    'providers' => [
    
        'admins' => [
            'driver' => 'eloquent',
            'model' => Sislamrafi\Admin\app\Models\Admin::class,
        ],
    ],

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
];