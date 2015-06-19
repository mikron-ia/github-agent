<?php

namespace FP\Larmo\GHAgent;

class Request {
    public static function isPostMethod() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }

        return false;
    }

    public static function getMessage() {
        return file_get_contents('php://input');
    }

    public static function getEventType() {
        foreach (getallheaders() as $name => $value) {
            if($name === 'X-GitHub-Event') {
                return $value;
            }
        }

        return null;
    }
}
