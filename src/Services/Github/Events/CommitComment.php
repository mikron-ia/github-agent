<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class CommitComment extends GithubEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'github.created_commit_comment';
    }

    protected function prepareBody($data)
    {
        return 'created commit comment';
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

        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'url' => $comment->html_url,
            'commit_id' => $comment->commit_id,
            'repository' => $this->getRepositoryInfo()
        ];
    }
}
