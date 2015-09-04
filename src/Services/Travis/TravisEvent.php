<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Travis;

use FP\Larmo\Agents\WebHookAgent\Services\EventAbstract;

class TravisEvent extends EventAbstract
{
    protected function prepareType($data)
    {
        return 'travis';
    }

    protected function prepareBody($data)
    {
        return  'The Travis CI build';
    }

    protected function prepareTimeStamp($data)
    {
        return $data->finished_at;
    }

    protected function prepareAuthor($data)
    {
        return [
            'name' => $data->committer_name,
            'email' => $data->committer_email
        ];
    }

    protected function prepareExtras($data)
    {
        return [
            'build_url' => $data->build_url,
            'number_build' => $data->number,
            'type' => $data->type,
            'state' => $data->state,
            'git_number' => $data->type == "push" ? $data->commit : $data->pull_request_number,
            'git_url' => $data->compare_url,
            'repository' => array(
                'name' => $data->repository->name,
                'owner' => $data->repository->owner_name,
                'branch' => $data->branch
            )
        ];
    }
}
