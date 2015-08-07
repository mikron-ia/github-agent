<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class PullRequest extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.pull_request_' . $data->action;
    }

    protected function prepareBody($data)
    {
        return $data->action . ' pull request';
    }

    protected function prepareTimeStamp($data)
    {
        $pullRequest = $data->pull_request;
        return $pullRequest->created_at;
    }

    protected function prepareAuthor($data)
    {
        $pullRequest = $data->pull_request;
        return [
            'login' => $pullRequest->user->login
        ];
    }

    protected function prepareExtras($data)
    {
        $pullRequest = $data->pull_request;
        return [
            'id' => $pullRequest->id,
            'number' => $pullRequest->number,
            'title' => $pullRequest->title,
            'body' => $pullRequest->body,
            'url' => $pullRequest->html_url,
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
