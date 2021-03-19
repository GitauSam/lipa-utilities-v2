<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'mpesa' => [
        'lipa_na_mpesa_url' => array_key_exists('LIPA_NA_MPESA_URL', $_SERVER) ? $_SERVER['LIPA_NA_MPESA_URL'] : env('LIPA_NA_MPESA_URL'),
        'kenya_power_paybill' => array_key_exists('KENYA_POWER_PAYBILL', $_SERVER) ? $_SERVER['KENYA_POWER_PAYBILL'] : env('KENYA_POWER_PAYBILL'),
        'paybill_transaction_type' => array_key_exists('MPESA_PAYBILL_TRANSACTION_TYPE', $_SERVER) ? $_SERVER['MPESA_PAYBILL_TRANSACTION_TYPE'] : env('MPESA_PAYBILL_TRANSACTION_TYPE'),
        'paybill_callback_url' => array_key_exists('MPESA_PAYBILL_CALLBACK_URL', $_SERVER) ? $_SERVER['MPESA_PAYBILL_CALLBACK_URL'] : env('MPESA_PAYBILL_CALLBACK_URL'),
        'timestamp_format' => array_key_exists('MPESA_TIMESTAMP_FORMAT', $_SERVER) ? $_SERVER['MPESA_TIMESTAMP_FORMAT'] : env('MPESA_TIMESTAMP_FORMAT'),
        'encoding_format' => array_key_exists('MPESA_ENCODING_FORMAT', $_SERVER) ? $_SERVER['MPESA_ENCODING_FORMAT'] : env('MPESA_ENCODING_FORMAT'),
        'lipa_na_mpesa_passkey' => array_key_exists('LIPA_NA_MPESA_PASSKEY', $_SERVER) ? $_SERVER['LIPA_NA_MPESA_PASSKEY'] : env('LIPA_NA_MPESA_PASSKEY'),
        'access_token_url' => array_key_exists('MPESA_ACCESS_TOKEN_URL', $_SERVER) ? $_SERVER['MPESA_ACCESS_TOKEN_URL'] : env('MPESA_ACCESS_TOKEN_URL'),
        'lipia_utilities_consumer_key' => array_key_exists('LIPIA_UTILITIES_CONSUMER_KEY', $_SERVER) ? $_SERVER['LIPIA_UTILITIES_CONSUMER_KEY'] : env('LIPIA_UTILITIES_CONSUMER_KEY'),
        'lipia_utilities_consumer_secret' => array_key_exists('LIPIA_UTILITIES_CONSUMER_SECRET', $_SERVER) ? $_SERVER['LIPIA_UTILITIES_CONSUMER_SECRET'] : env('LIPIA_UTILITIES_CONSUMER_SECRET'),
        'lipa_na_mpesa_success_code' => array_key_exists('LIPA_NA_MPESA_SUCCESS_CODE', $_SERVER) ? $_SERVER['LIPA_NA_MPESA_SUCCESS_CODE'] : env('LIPA_NA_MPESA_SUCCESS_CODE'),
        'lipa_na_mpesa_callback_user_cancelled_code' => array_key_exists('LIPA_NA_MPESA_CALLBACK_USER_CANCELLED_CODE', $_SERVER) ? $_SERVER['LIPA_NA_MPESA_CALLBACK_USER_CANCELLED_CODE'] : env('LIPA_NA_MPESA_CALLBACK_USER_CANCELLED_CODE'),
    ],

    'transaction' => [
        'success_status' => array_key_exists('TRANSACTION_SUCCESS_STATUS', $_SERVER) ? $_SERVER['TRANSACTION_SUCCESS_STATUS'] : env('TRANSACTION_SUCCESS_STATUS'),
        'exception_status' => array_key_exists('TRANSACTION_EXCEPTION_STATUS', $_SERVER) ? $_SERVER['TRANSACTION_EXCEPTION_STATUS'] : env('TRANSACTION_EXCEPTION_STATUS'),
        'ungranted_role_status' => array_key_exists('TRANSACTION_UNGRANTED_ROLE_STATUS', $_SERVER) ? $_SERVER['TRANSACTION_UNGRANTED_ROLE_STATUS'] : env('TRANSACTION_UNGRANTED_ROLE_STATUS'),
        'failure_status' => array_key_exists('TRANSACTION_FAILURE_STATUS', $_SERVER) ? $_SERVER['TRANSACTION_FAILURE_STATUS'] : env('TRANSACTION_FAILURE_STATUS'),
    ],

    'general' => [
        'month_date_year_format' => array_key_exists('MONTH_DAY_YEAR_FORMAT', $_SERVER) ? $_SERVER['MONTH_DAY_YEAR_FORMAT'] : env('MONTH_DAY_YEAR_FORMAT'),
        'user_role' => array_key_exists('USER_ROLE', $_SERVER) ? $_SERVER['USER_ROLE'] : env('USER_ROLE'),
        'moderator_role' => array_key_exists('MODERATOR_ROLE', $_SERVER) ? $_SERVER['MODERATOR_ROLE'] : env('MODERATOR_ROLE'),
        'super_admin_role' => array_key_exists('SUPER_ADMIN_ROLE', $_SERVER) ? $_SERVER['SUPER_ADMIN_ROLE'] : env('SUPER_ADMIN_ROLE'),
    ],

];
