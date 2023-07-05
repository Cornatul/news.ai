<?php

return [
    'linkedin' => [
        'clientId' => env('LINKEDIN_CLIENT_ID', ''),
        'clientSecret' => env('LINKEDIN_CLIENT_SECRET', ''),
        'redirectUri' => env('LINKEDIN_REDIRECT_URI', ''),
    ],
    'google' => [
        'clientId' => env('GOOGLE_CLIENT_ID', ''),
        'clientSecret' => env('GOOGLE_CLIENT_SECRET', ''),
        'redirectUri' => env('GOOGLE_REDIRECT_URI', ''),
    ],
    'twitter' => [
        'consumerKey' => env('TWITTER_CONSUMER_KEY', ''),
        'consumerSecret' => env('TWITTER_CONSUMER_SECRET', ''),
        'accessToken' => env('TWITTER_ACCESS_TOKEN', ''),
        'accessTokenSecret' => env('TWITTER_ACCESS_TOKEN_SECRET', ''),
        'apiVersion' => env('TWITTER_API_VERSION', '1.1'),
    ],

    'github' => [
        'clientId' => env('GITHUB_CLIENT_ID', ''),
        'clientSecret' => env('GITHUB_CLIENT_SECRET', ''),
        'redirectUri' => env('GITHUB_REDIRECT_URI', ''),
    ],
    'medium' => [
        'token' => env('MEDIUM_TOKEN', ''),
    ],
    'devto' => [
        'token' => env('DEVTO_TOKEN', ''),
    ],
    'tumblr' => [
        'identifier' => env('TUMBLR_IDENTIFIER', ''),
        'secret' => env('TUMBLR_SECRET', ''),
        'callback_uri' => env('TUMBLR_REDIRECT_URI', ''),
        'blog' => env('TUMBLR_BLOG_NAME', ''),
    ],
];
