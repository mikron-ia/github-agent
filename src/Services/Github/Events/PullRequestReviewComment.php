<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class PullRequestReviewComment extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.pull_request_review_comment_' . $data->action;
    }

    protected function prepareBody($data)
    {
        return $data->action . ' pull request review comment';
    }

    protected function prepareTimeStamp($data)
    {
        $comment = $data->comment;

        return $comment->created_at;
    }

    protected function prepareAuthor($data)
    {
        $comment = $data->comment;

        return [
            'login' => $comment->user->login
        ];
    }

    protected function prepareExtras($data)
    {
        $comment = $data->comment;
        $pullRequest = $data->pull_request;

        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'pull_request_number' => $pullRequest->number,
            'pull_request_url' => $pullRequest->html_url,
            'url' => $comment->html_url,
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
