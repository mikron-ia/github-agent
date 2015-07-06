<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Travis;

use FP\Larmo\Agents\WebHookAgent\Services\ServiceAbstract;

class TravisData extends ServiceAbstract
{
    public function __construct($data, $requestHeaders = null)
    {
        $this->serviceName = 'travis';
        $this->data = $this->prepareData($data);
    }

    protected function prepareData($data)
    {
        return array(
            'type' => 'travis',
            'timestamp' => $data->committed_at,
            'author' => array(
                'name' => $data->committer_name,
                'email' => $data->committer_email
            ),
            'body' => '',
            'extras' => json_decode($data, true)
        );
    }
}
