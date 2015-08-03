<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Trello;

use FP\Larmo\Agents\WebHookAgent\Services\ServiceAbstract;

class TrelloData extends ServiceAbstract
{
    protected $serviceName = 'trello';
    protected $eventHeader = 'HTTP_X_EVENT_KEY';
}