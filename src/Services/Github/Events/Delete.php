<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

class Delete extends EventAbstract
{
    protected function prepareMessages($dataObject)
    {
        $message = array(
            'type' => 'github.create_' . $dataObject->ref_type,
            'author' => array(
                'login' => $dataObject->sender->login
            ),
            'body' => 'created ' . $dataObject->ref_type,
            'extras' => array(
                'ref' => $dataObject->ref,
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
