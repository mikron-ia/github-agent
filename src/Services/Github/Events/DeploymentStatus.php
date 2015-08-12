<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class DeploymentStatus extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.deployment_status';
    }

    protected function prepareBody($data)
    {
        return 'deployment';
    }

    protected function prepareTimeStamp($data)
    {
        return $data->deployment_status->created_at;
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
            'deployment_status' => array(
                'state' => $data->deployment_status->state,
                'id' => $data->deployment_status->id,
                'description' => $data->deployment_status->description
            ),
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
