<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Gitlab\GitlabEvent;

class Push extends GitlabEvent
{
    protected function prepareMessages($dataObject)
    {
        $messages = array();

        foreach ($dataObject->commits as $commit) {
            $commitArray = $this->prepareSingleMessage($commit);
            $commitArray['extras']['repository'] = array(
                'name' => $dataObject->repository->name,
                'url' => $dataObject->repository->homepage
            );

            array_push($messages, $commitArray);
        }

        return $messages;
    }

    protected function prepareType($data)
    {
        return 'gitlab.commit';
    }

    protected function prepareBody($data)
    {
        return 'added commit';
    }

    protected function prepareTimeStamp($data)
    {
        return $data->timestamp;
    }

    protected function prepareAuthor($data)
    {
        return [
            'name' => $data->author->name,
            'email' => $data->author->email
        ];
    }

    protected function prepareExtras($data)
    {
        return [
            'id' => $data->id,
            'body' => $data->message,
            'url' => $data->url
        ];
    }
}
