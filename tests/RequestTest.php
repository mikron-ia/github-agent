<?php

use FP\Larmo\Agents\WebHookAgent\Request;

class RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function decoderFailsOnNonJsonFiles()
    {
        $this->setExpectedException("FP\\Larmo\\Agents\\WebHookAgent\\Exceptions\\InvalidIncomingDataException");
        Request::decodePostData("NOT JSON");
    }
}
