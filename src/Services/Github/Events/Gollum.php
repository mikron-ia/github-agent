<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

class Gollum extends EventAbstract
{
    protected function prepareMessages($dataObject)
    {
        $message = array(
            'type' => 'github.gollum',
            'author' => array(
                'login' => $dataObject->sender->login
            ),
            'body' => 'deployment',
            'extras' => array(
                'pages' => json_decode(json_encode($dataObject->pages), true),
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
