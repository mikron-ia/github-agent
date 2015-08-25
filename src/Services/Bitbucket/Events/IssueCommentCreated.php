<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\BitbucketEvent;

class IssueCommentCreated extends BitbucketEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'bitbucket.issue_comment_created';
    }

    protected function prepareBody($data)
    {
        $issue = $data->issue;

        return 'has commented on issue "' . $issue->title . '"';
    }

    protected function prepareTimeStamp($data)
    {
        $issue = $data->issue;

        return strtotime($issue->created_on);
    }

    protected function prepareAuthor($data)
    {
        $comment = $data->comment;

        return [
            'login' => $comment->user->username,
            'name' => $comment->user->display_name,
        ];
    }

    protected function prepareExtras($data)
    {
        $issue = $data->issue;
        $comment = $data->comment;

        return [
            'issue_id' => $issue->id,
            'comment_id' => $comment->id,
            'body' => $comment->content->raw,
            'html' => $comment->content->html,
            'url' => $comment->links->html->href,
        ];
    }
}