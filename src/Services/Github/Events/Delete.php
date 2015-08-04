<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Delete extends GithubEvent
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
                'repository' => $this->getRepositoryInfo()
            )
        );

        return array($message);
    }
}
