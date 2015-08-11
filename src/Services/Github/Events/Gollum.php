<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Gollum extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.gollum';
    }

    protected function prepareBody($data)
    {
        return 'deployment';
    }

    protected function prepareTimeStamp($data)
    {
        return date('c');
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
            'pages' => json_decode(json_encode($data->pages), true),
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
