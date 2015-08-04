<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Issues extends GithubEvent
{
    protected function prepareMessages($dataObject)
    {
        $issue = $dataObject->issue;

        $message = array(
            'type' => 'github.issue_' . $dataObject->action,
            'timestamp' => $issue->created_at,
            'author' => array(
                'login' => $issue->user->login
            ),
            'body' => $dataObject->action . ' issue',
            'extras' => array(
                'id' => $issue->id,
                'number' => $issue->number,
                'title' => $issue->title,
                'body' => $issue->body,
                'url' => $issue->html_url,
                'repository' => $this->getRepositoryInfo()
            ),
        );

        return array($message);
    }
}
