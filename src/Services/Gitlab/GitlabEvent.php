<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab;

use FP\Larmo\Agents\WebHookAgent\Services\EventAbstract;

abstract class GitlabEvent extends EventAbstract
{
    protected function prepareRepositoryData($repository)
    {
        return array(
            'name' => $repository->name,
            'full_name' => $repository->name,
            'owner' => null,
        );
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