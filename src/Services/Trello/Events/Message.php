<?php

namespace FP\Larmo\Agents\WebHookAgent\Services\Trello\Events;

use FP\Larmo\Agents\WebHookAgent\Services\Trello\TrelloEvent;

class Message extends TrelloEvent
{

    protected function prepareMessages($dataObject)
    {
        $messageArray = $this->prepareSingleMessage($dataObject);

        return [$messageArray];
    }

    protected function prepareType($data)
    {
        return 'trello.message';
    }

    protected function prepareBody($data)
    {
        $action = $data->action;

        return $action->memberCreator->fullName . ' performed ' . $action->type;
    }

    protected function prepareTimeStamp($data)
    {
        $action = $data->action;

        return strtotime($action->date);
    }

    protected function prepareAuthor($data)
    {
        $action = $data->action;

        return [
            'name' => $action->memberCreator->fullName,
            'login' => $action->memberCreator->username
        ];
    }

    protected function prepareExtras($data)
    {
        $model = $data->model;
        $action = $data->action;

        return [
            'id' => $action->id,
            'url' => $model->url,
            'action' => $action->type
        ];
    }

}
