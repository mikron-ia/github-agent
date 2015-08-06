<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\BitbucketEvent;

class IssueCreated extends BitbucketEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'bitbucket.issue_created';
    }

    protected function prepareBody($data)
    {
        $issue = $data->issue;

        return $issue->reporter->display_name . ' has created "' . $issue->title . '" issue';
    }

    protected function prepareTimeStamp($data)
    {
        $issue = $data->issue;

        return strtotime($issue->created_on);
    }

    protected function prepareAuthor($data)
    {
        $issue = $data->issue;

        return [
            'login' => $issue->reporter->username,
            'name' => $issue->reporter->display_name,
        ];
    }

    protected function prepareExtras($data)
    {
        $issue = $data->issue;

        return [
            'id' => $issue->id,
            'priority' => $issue->priority,
            'title' => $issue->title,
            'body' => $issue->content->raw,
            'html' => $issue->content->html,
            'url' => $issue->links->html->href,
            'attachments' => $issue->links->attachments->href,
            'votes' => $issue->votes,
            'watches' => $issue->watches,
            'type' => $issue->kind,
            'assignee' => [
                'login' => $issue->assignee->username,
                'name' => $issue->assignee->display_name,
            ],
        ];
    }
}