<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github;

use FP\Larmo\Agents\WebHookAgent\Services\ServiceAbstract;

class GithubData extends ServiceAbstract
{
    protected $serviceName = 'github';
    protected $eventHeader = 'HTTP_X_GITHUB_EVENT';
}