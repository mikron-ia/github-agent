<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab\Events;

use FP\Larmo\Agents\WebHookAgent\Services\EventInterface;

abstract class EventAbstract implements EventInterface
{
    private $messages;
    protected $type;

    public function __construct($data)
    {
        $this->messages = $this->prepareMessages($data);
    }

    public function getMessages()
    {
        return $this->messages;
    }

    protected function prepareMessages($dataObject)
    {
        $attributes = $dataObject->object_attributes;

        $message = array(
            'type' => 'gitlab.' . $this->type . '_' . $attributes->action,
            'timestamp' => $attributes->updated_at,
            'author' => array(
                'login' => $dataObject->user->username,
                'name' => $dataObject->user->name
            ),
            'body' => $attributes->action . ' ' . $this->getTypeAsString(),
            'extras' => array(
                'id' => $attributes->id,
                'number' => $attributes->iid,
                'title' => $attributes->title,
                'body' => $attributes->description,
                'url' => $attributes->url,
                'state' => $attributes->state
            )
        );

        return array($message);
    }

    private function getTypeAsString() {
        return implode(' ', explode('_', $this->type));
    }
}
