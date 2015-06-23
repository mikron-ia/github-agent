<?php

namespace FP\Larmo\Agents\WebHookAgent;

class Request
{
    private $server;
    private $payload;

    public function __construct() {
        $this->server = $_SERVER;
        $this->payload = file_get_contents('php://input');
    }

    public function isPostMethod()
    {
        return $this->server['REQUEST_METHOD'] === 'POST';
    }

    public function getUri()
    {
        return $this->server["REQUEST_URI"];
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getValueFromHeaderByKey($key)
    {
        return array_key_exists($key, $this->server) ? $this->server[$key] : false;
    }
}
