<?php

namespace FP\Larmo\Agents\WebHookAgent;

use FP\Larmo\Agents\WebHookAgent\Exceptions\InvalidIncomingDataException;

class Request
{
    public static function isPostMethod()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        } else {
            return false;
        }
    }

    public static function getUri()
    {
        return $_SERVER["REQUEST_URI"];
    }

    public static function getPostData()
    {
        return file_get_contents('php://input');
    }

    public static function decodePostData($data)
    {
        $decodedData = json_decode($data);

        if ($decodedData === null) {
            throw new InvalidIncomingDataException;
        } else {
            return $decodedData;
        }
    }

    public static function getValueFromHeaderByKey($key)
    {
        foreach ($_SERVER as $headerKey => $headerValue) {
            if ($key === $headerKey) {
                return $headerValue;
            }
        }

        return true;
    }
}
