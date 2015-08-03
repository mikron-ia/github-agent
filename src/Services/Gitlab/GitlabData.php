<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab;

use FP\Larmo\Agents\WebHookAgent\Services\ServiceAbstract;

class GitlabData extends ServiceAbstract
{
    protected $serviceName = 'gitlab';
    protected $eventHeader = 'X-Gitlab-Event';

    public function __construct($payload, $requestHeaders = null)
    {
        $this->eventType = $payload->object_kind;
        $this->data = $this->prepareData($payload);
    }
}
