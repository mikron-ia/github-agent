<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Scrutinizer;

use FP\Larmo\Agents\WebHookAgent\Services\ServiceAbstract;
use FP\Larmo\Agents\WebHookAgent\Exceptions\EventTypeNotFoundException;

class ScrutinizerData extends ServiceAbstract
{
    protected $serviceName = 'scrutinizer';
    protected $eventHeader = 'X-Scrutinizer-Event';

    protected function prepareData($data)
    {
        if ($data->state === 'completed') {
            $event = new ScrutinizerEvent($data);
            return $event->getMessages();
        } else {
            throw new EventTypeNotFoundException;
        }
    }
}
