<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Bitbucket;

use FP\Larmo\Agents\WebHookAgent\Services\EventAbstract;

abstract class BitbucketEvent extends EventAbstract
{
    protected function prepareRepositoryData($repository)
    {
        return array(
            'name' => $repository->name,
            'full_name' => $repository->full_name,
            'owner' => isset($repository->owner->display_name) ? $repository->owner->display_name : $repository->owner->username
        );
    }
}