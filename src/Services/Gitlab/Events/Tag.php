<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab\Events;

class Tag extends EventAbstract
{
    protected function prepareMessages($dataObject)
    {
        $message = array(
            'type' => 'gitlab.dataObject',
            'author' => array(
                'name' => $dataObject->user_name,
            ),
            'body' => 'pushed tag',
            'extras' => array(
                'ref' => $dataObject->ref,
                'before' => $dataObject->before,
                'after' => $dataObject->after,
                'repository' => array(
                    'name' => $dataObject->repository->name,
                    'url' => $dataObject->repository->homepage
                )
            )
        );

        return array($message);
    }

}
