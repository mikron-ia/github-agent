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
            $commit = $change->new->target;
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
        return $data->author->user->display_name . ' added commit: "' . $data->message . '"';
    }

    protected function prepareTimeStamp($data)
    {
        return strtotime($data->date);
    }

    protected function prepareAuthor($data)
    {
        return [
            'name' => $data->author->user->display_name,
            'email' => $data->author->raw,
            'login' => $data->author->user->username
        ];
    }

    protected function prepareExtras($data)
    {
        return [
            'body' => $data->message,
            'url' => $data->links->html->href,
            'hash' => $data->hash
        ];
    }


}