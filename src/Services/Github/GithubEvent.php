<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github;

use FP\Larmo\Agents\WebHookAgent\Services\EventAbstract;

abstract class GithubEvent extends EventAbstract
{
    protected function prepareRepositoryData($repository)
    {
        return array(
            'name' => $repository->name,
            'full_name' => $repository->full_name,
            'owner' => isset($repository->owner->login) ? $repository->owner->login : $repository->owner->name
        );
    }
}