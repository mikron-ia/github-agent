<?php

use FP\Larmo\Agents\WebHookAgent\Packet;

class PacketTest extends PHPUnit_Framework_TestCase
{
    private $message;

    public function setup()
    {
        $this->message = "";
        $this->packet = new Packet($this->message);
    }
}
