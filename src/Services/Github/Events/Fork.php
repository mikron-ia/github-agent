<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Fork extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.fork';
    }

    protected function prepareBody($data)
    {
        return 'deployment';
    }

    protected function prepareTimeStamp($data)
    {
        return $data->forkee->created_at;
    }

    protected function prepareAuthor($data)
    {
        return [
            'login' => $data->sender->login
        ];
    }

    protected function prepareExtras($data)
    {
        return [
            'fork' => array(
                'name' => $data->forkee->name,
                'full_name' => $data->forkee->full_name,
                'owner' => $data->forkee->owner->login
            ),
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
