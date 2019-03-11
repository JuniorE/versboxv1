<?php

    /*
     * You can place your custom package configuration in here.
     */
    return [

        'resource_url' => '/latches/allocation/temporary',

        'operator_code' => env('CLP_API_OPERATOR_CODE', 'ITRX0200'),
        'api_secret'    => env('CLP_API_SECRET', '7DB1RP3UM8SI0ER2AL1GT6KH5WJ4FL4KG8AP4NC8'),
        'auth_login'    => env('CLP_API_USER_E_MAIL', 'junior@itreflex.be'),
        'auth_password' => env('CLP_API_USER_PASSWORD', 'xxxxxx'),

    ];