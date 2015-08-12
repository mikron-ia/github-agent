<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Travis;

use FP\Larmo\Agents\WebHookAgent\Services\ServiceAbstract;

class TravisData extends ServiceAbstract
{
    protected $serviceName = 'travis';

    protected function prepareData($data)
    {
        $event = new TravisEvent($data);
        return $event->getMessages();
    }
}
