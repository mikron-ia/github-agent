<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Gitlab\GitlabEvent;

class Note extends GitlabEvent
{
    protected function prepareMessages($dataObject)
    {
        $comment = $dataObject->object_attributes;
        $type = strtolower($comment->noteable_type);

        $message = array(
            'type' => 'gitlab.comment_' . $type,
            'timestamp' => $comment->updated_at,
            'author' => array(
                'name' => $dataObject->user->name,
                'login' => $dataObject->user->username
            ),
            'body' => 'added comment',
            'extras' => array(
                'id' => $comment->id,
                'url' => $comment->url,
                'body' => $comment->note,
                'repository' => array(
                    'name' => $dataObject->repository->name,
                    'url' => $dataObject->repository->homepage
                )
            )
        );

        switch($type){
            case 'mergerequest':
                $message['extras']['merge_request'] = $this->extraDataMergeRequest($dataObject->merge_request);
                break;
            case 'commit':
                $message['extras']['commit'] = $this->extraDataCommit($dataObject->commit);
                break;
            case 'issue':
                $message['extras']['issue'] = $this->extraDataIssue($dataObject->issue);
                break;
            case 'snippet':
                $message['extras']['snippet'] = $this->extraDataSnippet($dataObject->snippet);
                break;
        }

        return array($message);
    }

    private function extraDataMergeRequest($mr) {
        return array(
            'id' => $mr->id,
            'number' => $mr->iid,
            'title' => $mr->title
        );
    }

    private function extraDataCommit($commit) {
        return array(
            'url' => $commit->url,
            'id' => $commit->id
        );
    }

    private function extraDataIssue($issue) {
        return array(
            'id' => $issue->id,
            'number' => $issue->iid,
            'title' => $issue->title
        );
    }

    private function extraDataSnippet($snippet) {
        return array(
            'id' => $snippet->id,
            'title' => $snippet->title,
            'file' => $snippet->file_name
        );
    }
}
