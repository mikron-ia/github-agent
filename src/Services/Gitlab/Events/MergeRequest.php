<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Gitlab\Events;

class MergeRequest extends EventAbstract
{
    protected $type = 'merge_request';
}
