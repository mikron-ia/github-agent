<?php

use FP\Larmo\Agents\WebHookAgent\Services\Travis\TravisData;

class TravisTest extends BaseEventsTest
{
    /**
     * @test
     */
    public function travisReturnsCorrectData()
    {
        $travis = new TravisData($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/travis.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/travis.json'), true);

        $this->assertEquals($expectedResult, $travis->getData());
    }
}
