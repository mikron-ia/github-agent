<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

class Deployment extends EventAbstract
{
    protected function prepareMessages($dataObject)
    {
        $message = array(
            'type' => 'github.deployment',
            'timestamp' => $dataObject->deployment->created_at,
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
