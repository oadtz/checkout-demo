<?php

return [
    'currencies'        => ['USD', 'EUR', 'THB', 'HKD', 'SGD', 'AUD'],
    'adyen' => [
        'username'      =>  env('ADYEN_USERNAME', ''),
        'password'      =>  env('ADYEN_PASSWORD', ''),
        'environment'   =>  env('ADYEN_ENVIRONMENT', 'test'),
        'appname'       =>  env('ADYEN_APPNAME', ''),
        'merchant_account' => env('ADYEN_MERCHANT_ACCOUNT', '')
    ],
    'braintree' =>  [
        'environment'   => env('BRAINTREE_ENVIRONMENT', 'sandbox'),
        'merchant_id'   => env('BRAINTREE_MERCHANT_ID', ''),
        'public_key'    => env('BRAINTREE_PUBLIC_KEY', ''),
        'private_key'    => env('BRAINTREE_PRIVATE_KEY', '')
    ]

];
