<?php

return [
    [
        'key' => 'masters.branchSettings',
        'name' => 'admin::app.admin.system.branch-settings',
        'sort' => 3,
    ],[
        'key' => 'masters.branchSettings.branch_number',
        'name' => 'admin::app.admin.system.branchNumber',
        'sort' => 0,
        'fields' => [
            [
                'name' => 'branch_number_prefix',
                'title' => 'admin::app.admin.system.branch-number-prefix',
                'type' => 'text',
                'validation' => false,
                'channel_based' => true,
                'locale_based' => true
            ],
            /*[
                'name' => 'order_number_length',
                'title' => 'admin::app.admin.system.order-number-length',
                'type' => 'text',
                'validation' => 'numeric',
                'channel_based' => true,
                'locale_based' => true
            ],
            [
                'name' => 'order_number_suffix',
                'title' => 'admin::app.admin.system.order-number-suffix',
                'type' => 'text',
                'validation' => false,
                'channel_based' => true,
                'locale_based' => true
            ],*/
        ]
    ]
];