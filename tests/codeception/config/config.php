<?php
/**
 * Application configuration shared by all test types
 */
return [
    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],
        'request' => [
           'cookieValidationKey' => $_ENV['APP_COOKIE_VALIDATION_KEY']
        ],
    ],
];
