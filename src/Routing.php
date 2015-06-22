<?php
/**
 * Created by PhpStorm.
 * User: mlabedowicz
 * Date: 2015-06-19
 * Time: 16:22
 */

namespace FP\Larmo\Agents\WebHookAgent;

class Routing
{
    private $uri;
    private $message;

    public function __construct($uri, $message)
    {
        $this->uri = $uri;
        $this->message = $message;
    }

    public function getSourceIdentifier()
    {
        $cleansedUri = trim(str_replace("http://", "", $this->uri));

        /* Verify whether URI ends in "/" and cut it out if needed */
        if (mb_substr($cleansedUri, -1) === "/") {
            $uriToSegmentate = mb_substr($cleansedUri, 0, strlen($cleansedUri) - 1);
        } else {
            $uriToSegmentate = $cleansedUri;
        }

        /* Extract identifier - last segment of the URI */
        $uriSegments = explode("/", $uriToSegmentate);
        if (!empty($uriSegments)) {
            $finalUriSegment = array_pop($uriSegments);
        } else {
            $finalUriSegment = null;
        }

        return $finalUriSegment;
    }

    public function getService()
    {
        $sourceIdentifier = $this->getSourceIdentifier();

        try {
            switch ($sourceIdentifier) {
                case 'github':
                    $service = new Services\Github\GithubData($this->message);
                    break;
                default:
                    $service = null;
                    break;
            }
        } catch (Exception $e) {
            file_put_contents("php://stderr", $e->getMessage());
            $service = null;
        }

        return $service;
    }
}