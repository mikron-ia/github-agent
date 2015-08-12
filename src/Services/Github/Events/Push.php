<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Push extends GithubEvent
{
    private $branch;

    protected function prepareMessages($dataObject)
    {
        $messages = array();
        $this->branch = str_replace('refs/heads/', '', $dataObject->ref);

        foreach ($dataObject->commits as $commit) {
            array_push($messages, $this->prepareSingleMessage($commit));
        }

        return $messages;
    }

    protected function prepareType($data)
    {
        return 'github.commit';
    }

    protected function prepareBody($data)
    {
        return 'added commit';
    }

    protected function prepareTimeStamp($data)
    {
        return $data->timestamp;
    }

    protected function prepareAuthor($data)
    {
        return [
            'name' => $data->author->name,
            'email' => $data->author->email,
            'login' => $data->author->username
        ];
    }

    protected function prepareExtras($data)
    {
        return [
            'id' => $data->id,
            'files' => [
                'added' => $data->added,
                'removed' => $data->removed,
                'modified' => $data->modified
            ],
            'body' => $data->message,
            'url' => $data->url,
            'branch' => $this->branch,
            'repository' => $this->getRepositoryInfo()
        ];
    }
}