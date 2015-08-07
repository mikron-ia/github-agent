<?php

namespace FP\Larmo\Agents\WebHookAgent\Services;

abstract class EventAbstract implements EventInterface
{
    private $messages;
    private $repositoryInfo;

    public function __construct($data)
    {
        $this->repositoryInfo = $this->setRepositoryInfo($data);
        $this->messages = $this->prepareMessages($data);
        $this->prepareInternalData($data);
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

    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    final protected function prepareSingleMessage($data)
    {
        $message = [
            'type' => $this->prepareType($data),
            'timestamp' => $this->prepareTimeStamp($data),
            'author' => $this->prepareAuthor($data),
            'body' => $this->prepareBody($data),
            'extras' => $this->prepareExtras($data)
        ];

        return $message;
    }

    protected function prepareInternalData($data)
    {

    }

    abstract protected function prepareRepositoryData($repository);

    abstract protected function prepareType($data);

    abstract protected function prepareBody($data);

    abstract protected function prepareTimeStamp($data);

    abstract protected function prepareAuthor($data);

    abstract protected function prepareExtras($data);
}
