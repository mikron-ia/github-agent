<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

class DeploymentStatus extends EventAbstract
{
    protected function prepareMessages($dataObject)
    {
        $message = array(
            'type' => 'github.deployment_status',
            'timestamp' => $dataObject->deployment_status->created_at,
            'author' => array(
                'login' => $dataObject->sender->login
            ),
            'body' => 'deployment',
            'extras' => array(
                'deployment' => array(
                    'id' => $dataObject->deployment->id,
                    'sha' => $dataObject->deployment->sha,
                    'ref' => $dataObject->deployment->ref,
                    'task' => $dataObject->deployment->task,
                    'environment' => $dataObject->deployment->environment
                ),
                'deployment_status' => array(
                    'state' => $dataObject->deployment_status->state,
                    'id' => $dataObject->deployment_status->id,
                    'description' => $dataObject->deployment_status->description
                ),
                'repository' => array(
                    'name' => $dataObject->repository->name,
                    'full_name' => $dataObject->repository->full_name,
                    'owner' => $dataObject->repository->owner->login
                )
            )
        );

        return array($message);
    }
}
