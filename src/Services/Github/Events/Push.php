<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Github\EventInterface;

class Push implements EventInterface {
    private $messages;

    public function __construct($data) {
        $this->messages = $this->prepareMessages($data);
    }

    public function getMessages() {
        return $this->messages;
    }

    private function prepareMessages($dataObject) {
        $messages = array();

        foreach($dataObject->commits as $commit) {
            array_push($messages, $this->getArrayFromCommit($commit));
        }

        return $messages;
    }

    private function getArrayFromCommit($commit) {
        return array(
            'type' => 'commit',
            'timestamp' => $commit->timestamp,
            'author' => array(
                'name' => $commit->author->name,
                'email' => $commit->author->email,
                'login' => $commit->author->username
            ),
            'message' => $commit->author->name . ' added commit: "' . $commit->message . '"',
            'extras' => array(
                'id' => $commit->id,
                'files' => array(
                    'added' => $commit->added,
                    'removed' => $commit->removed,
                    'modified' => $commit->modified
                ),
                'message' => $commit->message,
                'url' => $commit->url
            )
        );
    }
}