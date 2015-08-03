<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Github\Events;

use FP\Larmo\Agents\WebHookAgent\Services\EventInterface;

abstract class EventAbstract implements EventInterface
{
    private $messages;
    private $repositoryInfo;

    public function __construct($data)
    {
        $this->repositoryInfo = $this->setRepositoryInfo($data);
        $this->messages = $this->prepareMessages($data);
    }

    private function setRepositoryInfo($data)
    {
        $repository = $data->repository;
        if(!isset($repository)) {
            return null;
        }

        return array(
            'name' => $repository->name,
            'full_name' => $repository->full_name,
            'owner' => isset($repository->owner->login) ? $repository->owner->login : $repository->owner->name
        );
    }

    public function getRepositoryInfo()
    {
        return $this->repositoryInfo;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    abstract protected function prepareMessages($data);
}
