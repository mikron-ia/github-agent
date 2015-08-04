<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class IssueComment extends GithubEvent
{
    protected function prepareMessages($dataObject)
    {
        $issue = $dataObject->issue;
        $comment = $dataObject->comment;

        $message = array(
            'type' => 'github.issue_comment_' . $dataObject->action,
            'timestamp' => $comment->created_at,
            'author' => array(
                'login' => $comment->user->login
            ),
            'body' => $dataObject->action . ' issue comment',
            'extras' => array(
                'id' => $comment->id,
                'issue_id' => $issue->id,
                'issue_number' => $issue->number,
                'issue_title' => $issue->title,
                'body' => $comment->body,
                'url' => $comment->html_url,
                'repository' => $this->getRepositoryInfo()
            )
        );

        return array($message);
    }
}
