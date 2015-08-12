<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Deployment extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.deployment';
    }

    protected function prepareBody($data)
    {
        return 'deployment';
    }

    protected function prepareTimeStamp($data)
    {
        return $data->deployment->created_at;
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
            'deployment' => array(
                'id' => $data->deployment->id,
                'sha' => $data->deployment->sha,
                'ref' => $data->deployment->ref,
                'task' => $data->deployment->task,
                'environment' => $data->deployment->environment
            ),
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
