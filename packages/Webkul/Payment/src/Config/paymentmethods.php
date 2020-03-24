<?php
return [
    'cashondelivery' => [
        'code' => 'cashondelivery',
        'title' => 'Cash On Delivery',
        'description' => 'Cash On Delivery',
        'class' => 'Swim\Payment\Payment\CashOnDelivery',
        'active' => true,
        'sort' => 1
    ],

    'moneytransfer' => [
        'code' => 'moneytransfer',
        'title' => 'Money Transfer',
        'description' => 'Money Transfer',
        'class' => 'Swim\Payment\Payment\MoneyTransfer',
        'active' => true,
        'sort' => 2
    ],

    'paypal_standard' => [
        'code' => 'paypal_standard',
        'title' => 'Paypal Standard',
        'description' => 'Paypal Standard',
        'class' => 'Swim\Paypal\Payment\Standard',
        'sandbox' => true,
        'active' => true,
        'business_account' => 'test@Swim.com',
        'sort' => 3
    ]
];