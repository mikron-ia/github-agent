<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\BitbucketEvent;

/**
 * Class Push
 * @package FP\Larmo\Agents\WebHookAgent\Services\Bitbucket\Events
 *
 * Handles pushed commits
 * Caution: BitBucket is not providing entirety of data in push report, only the last commit and information regarding
 * previous HEAD. Therefore, this event will not report all commits in a push, just the most recent one; this appears
 * to be intentional behaviour of BitBucket API
 *
 */
class RepoPush extends BitbucketEvent
{
    protected function prepareMessages($data)
    {
        $messages = array();

        foreach ($data->push->changes as $change) {
            $commit = $change->new;
            array_push($messages, $this->prepareSingleMessage($commit));
        }

        return $messages;
    }

    protected function prepareType($data)
    {
        return 'bitbucket.commit';
    }

    protected function prepareBody($data)
    {
        return 'added commit';
    }

    protected function prepareTimeStamp($data)
    {
        return strtotime($data->target->date);
    }

    protected function prepareAuthor($data)
    {
        return [
            'name' => $data->target->author->user->display_name,
            'email' => $data->target->author->raw,
            'login' => $data->target->author->user->username
        ];
    }

    protected function prepareExtras($data)
    {
        return [
            'body' => $data->target->message,
            'url' => $data->target->links->html->href,
            'hash' => $data->target->hash,
            'branch' => $data->name,
            'repository' => $this->getRepositoryInfo()
        ];
    }


}