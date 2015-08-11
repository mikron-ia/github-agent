<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Trello;

use FP\Larmo\Agents\WebHookAgent\Services\EventAbstract;

abstract class TrelloEvent extends EventAbstract
{
    protected function prepareRepositoryData($repository)
    {
        return array(
            'name' => $repository->name,
            'full_name' => $repository->name,
            'owner' => null,
        );
    }

    private function getTypeAsString()
    {
        return implode(' ', explode('_', $this->type));
    }
}
