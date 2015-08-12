<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class Issues extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.issue_' . $data->action;
    }

    protected function prepareBody($data)
    {
        return $data->action . ' issue';
    }

    protected function prepareTimeStamp($data)
    {
        $issue = $data->issue;
        return $issue->created_at;
    }

    protected function prepareAuthor($data)
    {
        $issue = $data->issue;
        return [
            'login' => $issue->user->login
        ];
    }

    protected function prepareExtras($data)
    {
        $issue = $data->issue;
        return [
            'id' => $issue->id,
            'number' => $issue->number,
            'title' => $issue->title,
            'body' => $issue->body,
            'url' => $issue->html_url,
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
