<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

class Watch extends EventAbstract
{
    protected function prepareMessages($dataObject)
    {
        $message = array(
            'type' => 'github.watch_' . $dataObject->action,
            'author' => array(
                'login' => $dataObject->sender->login
            ),
            'body' => $dataObject->action . ' watching repository',
            'extras' => array(
                'action' => $dataObject->action,
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
