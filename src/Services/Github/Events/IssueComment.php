<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class IssueComment extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.issue_comment_' . $data->action;
    }

    protected function prepareBody($data)
    {
        return $data->action . ' issue comment';
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
        $issue = $data->issue;
        $comment = $data->comment;

        return [
            'id' => $comment->id,
            'issue_id' => $issue->id,
            'issue_number' => $issue->number,
            'issue_title' => $issue->title,
            'body' => $comment->body,
            'url' => $comment->html_url,
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
