<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Bitbucket;

use FP\Larmo\Agents\WebHookAgent\Services\ServiceAbstract;
use FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\Events;

class BitbucketData extends ServiceAbstract
{
    protected $serviceName = 'bitbucket';
    protected $eventHeader = 'HTTP_X_EVENT_KEY';

    protected function getEventClass()
    {
        $eventType = str_replace(':','_',$this->eventType);
        $eventTypeArray = explode('_', $eventType);
        $eventClassPath = '\\FP\\Larmo\\Agents\\WebHookAgent\\Services\\' . ucfirst($this->serviceName) . '\\Events\\';
        return $eventClassPath . implode('', array_map('ucfirst', $eventTypeArray));
    }
}
