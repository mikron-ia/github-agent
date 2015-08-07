<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Gitlab\GitlabEvent;

class Tag extends GitlabEvent
{
    protected function prepareMessages($data)
    {
        return [$this->prepareSingleMessage($data)];
    }

    protected function prepareType($data)
    {
        return 'gitlab.dataObject';
    }

    protected function prepareBody($data)
    {
        return 'pushed tag';
    }

    protected function prepareTimeStamp($data)
    {
        return null;
    }

    protected function prepareAuthor($data)
    {
        return [
            'name' => $data->user_name,
        ];
    }

    protected function prepareExtras($data)
    {
        return [
            'ref' => $data->ref,
            'before' => $data->before,
            'after' => $data->after,
            'repository' => array(
                'name' => $data->repository->name,
                'url' => $data->repository->homepage
            )
        ];
    }
}
