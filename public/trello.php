<?php

require_once('../vendor/autoload.php');
require_once('../config/config.php');

$key = $config['trello']['applicationKey'];
$token = $config['trello']['accessToken'];
$boards = $config['trello']['boards'];

if (empty($key)) {
    echo 'There is no application key in config file. Log in to trello.com, go to '
        . '<a href="https://trello.com/app-key">https://trello.com/app-key#</a>, and copy Key field to `applicationKey` '
        . 'field of `trello` config array';
} elseif (empty($token)) {
    $url = 'https://trello.com/1/authorize?key=' . $key . '&name=Webhook+Larmo+Agent&expiration=1hour&response_type=token&scope=read';
    echo 'There is no authorization token in config file. <a href="' . $url . '">Go to this page</a> whilst logged in to '
        . 'Trello and confirm access. This will redirect you to a page with a token that you should copy in `accessToken`'
        . ' field of `trello` config array';
} elseif (empty($boards)) {
    echo 'There are no boards listed. Please go to <a href="https://trello.com/1/members/me/boards?fields=name">boards list</a>'
        . ' and list them in `boards` field of `trello` config array';
} else {
    $uri = 'https://trello.com/1/tokens/' . $token . '/webhooks/?key=' . $key;
    $errors = [];

    try {
        foreach ($boards as $board) {

            $data = [
                'description' => 'Larmo Webhook Agent',
                'callbackURL' => $config['agentURI'],
                'idModel' => $board,
            ];

            $curl = curl_init($uri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $curl_response = curl_exec($curl);
            $curl_err = curl_errno($curl);
            $curl_msg = curl_error($curl);
            $curl_header = curl_getinfo($curl);
            curl_close($curl);

            if ($curl_err || $curl_msg) {
                $errors[] = 'webhook creation error for ' . $board . ': ' . $curl_msg;
            }
        }
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

    if (!empty($errors)) {
        echo 'Errors encountered: ' . implode('; ', $errors);
    } else {
        echo "Webhooks created successfully";
    }

}