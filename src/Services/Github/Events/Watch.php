<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Watch extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.watch_' . $data->action;
    }

    protected function prepareBody($data)
    {
        return $data->action . ' watching repository';
    }

    protected function prepareTimeStamp($data)
    {
        return null;
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
            'action' => $data->action,
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
