<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Gitlab\GitlabEvent;

class Push extends GitlabEvent
{
    protected function prepareMessages($dataObject)
    {
        $messages = array();

        foreach ($dataObject->commits as $commit) {
            $commitArray = $this->getArrayFromCommit($commit);
            $commitArray['extras']['repository'] = array(
                'name' => $dataObject->repository->name,
                'url' => $dataObject->repository->homepage
            );

            array_push($messages, $commitArray);
        }

        return $messages;
    }

    protected function getArrayFromCommit($commit)
    {
        return array(
            'type' => 'gitlab.commit',
            'timestamp' => $commit->timestamp,
            'author' => array(
                'name' => $commit->author->name,
                'email' => $commit->author->email
            ),
            'body' => 'added commit',
            'extras' => array(
                'id' => $commit->id,
                'body' => $commit->message,
                'url' => $commit->url
            )
        );
    }

}
