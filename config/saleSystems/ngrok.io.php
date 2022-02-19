<?php

return [
    'id' => 1,
    'APP_NAME' => 'ngork',
    'MAIL_FROM_ADDRESS' => 'saleSystem@dev.com',
    'domain' => '8358-95-216-251-47.ngrok.io',
    'front_app' => 'http://8358-95-216-251-47-from.ngrok.io',
    'database_host' => env('DB_HOST'),
    'database_name' => 'ngork',
    'database_port' => env('DB_PORT'),
    'database_user' => env('DB_USERNAME'),
    'database_password' => env('DB_PASSWORD', ''),
    'default_warranty_days' => 14,
    'is_active' => true,
    'has_warehouse' => true,
    'register_number' => '',
    'register_office' => '',
    'phone' => '',
    'fax' => '',
    'has_network' => true,
    'has_btob' => true,
    'has_btoc' => true,
    'has_delivery' => true,
    'warranty_days' => 14,
    'max_client_root' => 12,
    'template' => 'sale-system',
];