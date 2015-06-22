<?php

require_once('../vendor/autoload.php');

use FP\Larmo\Agents\WebHookAgent\Packet;
use FP\Larmo\Agents\WebHookAgent\Request;
use FP\Larmo\Agents\WebHookAgent\Routing;
use FP\Larmo\Agents\WebHookAgent\Services;

header("Content-type: application/json; charset=utf-8");

if (Request::isPostMethod()) {
    $uri = Request::getUri();
    $postData = json_decode(Request::getPostData());

    $routing = new Routing($uri, $postData);
    $service = $routing->getService();

    if ($service === null) {
        http_response_code(404); //This URI was not found - thus 404
    }

    try {
        $packet = new Packet($service->getData());
        $packet->send();
    } catch (InvalidArgumentException $e) {
        http_response_code(404);
    }
} else {
    http_response_code(405);
}
