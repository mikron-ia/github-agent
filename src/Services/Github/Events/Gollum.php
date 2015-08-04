<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Gollum extends GithubEvent
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
                'repository' => $this->getRepositoryInfo()
            )
        );

        return array($message);
    }
}
