<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubEvent;

class CommitComment extends GithubEvent
{

    protected function prepareMessages($dataObject)
    {
        $comment = $dataObject->comment;

        $message = array(
            'type' => 'github.created_commit_comment',
            'timestamp' => $comment->created_at,
            'author' => array(
                'login' => $comment->user->login
            ),
            'body' => 'created commit comment',
            'extras' => array(
                'id' => $comment->id,
                'body' => $comment->body,
                'url' => $comment->html_url,
                'commit_id' => $comment->commit_id,
                'repository' => $this->getRepositoryInfo()
            ),
        );

        return array($message);
    }

}