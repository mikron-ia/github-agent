<?php

namespace FP\Larmo\Agents\WebHookAgent\Services;

abstract class EventAbstract
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
        if (!isset($data->repository)) {
            return null;
        } else {
            $repository = $data->repository;
        }

        $repositoryData = $this->prepareRepositoryData($repository);

        return $repositoryData;
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
    abstract protected function prepareRepositoryData($repository);
}
