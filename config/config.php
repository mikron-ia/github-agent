<?php

$config = [
    'authentication' => getenv('authinfo'),
    'hubURI' => getenv('hub_uri'),
    'agentURI' => $_SERVER['HTTP_HOST'],
    'trello' => [
        'applicationKey' => '4cdab709769848b326ae9cc609ba1be6',
        'accessToken' => '7243aa390181f08b57ed4687ea5c9489575a5c0ab62ba038924b0e432271f694',
        'boards' => [
            '557ac040afe52a5b292a6d3c',
            '55930bd2c6012b2b9c60fa73',
        ],
    ],
];
