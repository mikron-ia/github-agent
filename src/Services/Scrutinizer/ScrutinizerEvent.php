<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Scrutinizer;


use FP\Larmo\Agents\WebHookAgent\Services\EventAbstract;

class ScrutinizerEvent extends EventAbstract
{
    protected function prepareRepositoryData($repository)
    {
        return array(
            'name' => $repository->name,
            'full_name' => $repository->name,
            'owner' => $repository->user,
        );
    }

    protected function prepareType($data)
    {
        return 'scrutinizer.' . $data->state;
    }

    protected function prepareBody($data)
    {
        return 'Scrutinizer CI inspection';
    }

    protected function prepareTimeStamp($data)
    {
        return $data->finished_at;
    }

    protected function prepareAuthor($data)
    {
        return [];
    }

    protected function prepareExtras($data)
    {
        $diff = $data->_embedded->index_diff;
        return [
            'id' => $data->uuid,
            'repository' => array(
                'user' => isset($data->metadata->source) ? $data->metadata->source->login : $data->_embedded->repository->login,
                'branch' => isset($data->metadata->source) ? $data->metadata->source->branch : $data->metadata->branch,
                'name' => isset($data->metadata->source) ? $data->metadata->source->repository : $data->_embedded->repository->name
            ),
            'pull_request_number' => isset($data->pull_request_number) ? $data->pull_request_number : '',
            'status' => $data->build->status,
            'results' => array(
                'new_issues' => $diff->nb_new_issues,
                'common_issues' => $diff->nb_common_issues,
                'fixed_issues' => $diff->nb_new_issues,
                'added_code_elements' => $diff->nb_added_code_elements,
                'common_code_elements' => $diff->nb_common_code_elements,
                'changed_code_elements' => $diff->nb_changed_code_elements,
                'removed_code_elements' => $diff->nb_removed_code_elements
            )
        ];
    }
}
