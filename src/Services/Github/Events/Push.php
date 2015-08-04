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
            array_push($messages, $this->getArrayFromCommit($commit));
        }

        return $messages;
    }

    protected function getArrayFromCommit($commit)
    {
        return array(
            'type' => 'github.commit',
            'timestamp' => $commit->timestamp,
            'author' => array(
                'name' => $commit->author->name,
                'email' => $commit->author->email,
                'login' => $commit->author->username
            ),
            'body' => 'added commit',
            'extras' => array(
                'id' => $commit->id,
                'files' => array(
                    'added' => $commit->added,
                    'removed' => $commit->removed,
                    'modified' => $commit->modified
                ),
                'body' => $commit->message,
                'url' => $commit->url,
                'branch' => $this->branch,
                'repository' => $this->getRepositoryInfo()
            )
        );
    }
}