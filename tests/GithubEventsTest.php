<?php

use FP\Larmo\Agents\WebHookAgent\Services\Github\GithubData;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Push;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\CommitComment;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\PullRequest;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Issues;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\IssueComment;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Create;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Delete;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Watch;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Deployment;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\DeploymentStatus;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Fork;
use FP\Larmo\Agents\WebHookAgent\Services\Github\Events\Gollum;


class GithubEventsTest extends BaseEventsTest
{
    /**
     * @test
     */
    public function pushEventReturnsCorrectData()
    {
        $push = new Push($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-push.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-push.json'), true);

        $this->assertEquals($expectedResult, $push->getMessages());
    }

    /**
     * @test
     */
    public function commitCommentEventReturnsCorrectData()
    {
        $commitComment = new CommitComment($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-commit_comment.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-commit_comment.json'), true);

        $this->assertEquals($expectedResult, $commitComment->getMessages());
    }

    /**
     * @test
     */
    public function pullRequestEventReturnsCorrectData()
    {
        $pullRequest = new PullRequest($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-pull_request.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-pull_request.json'), true);

        $this->assertEquals($expectedResult, $pullRequest->getMessages());
    }

    /**
     * @test
     */
    public function issueEventReturnsCorrectData()
    {
        $issue = new Issues($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-issue.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-issue.json'), true);

        $this->assertEquals($expectedResult, $issue->getMessages());
    }

    /**
     * @test
     */
    public function issueCommentEventReturnsCorrectData()
    {
        $issueComment = new IssueComment($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-issue_comment.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-issue_comment.json'), true);

        $this->assertEquals($expectedResult, $issueComment->getMessages());
    }

    /**
     * @test
     */
    public function createEventReturnsCorrectData()
    {
        $create = new Create($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-create_tag.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-create_tag.json'), true);

        $this->assertEquals($expectedResult, $create->getMessages());
    }

    /**
     * @test
     */
    public function deleteEventReturnsCorrectData()
    {
        $delete = new Delete($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-delete_tag.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-delete_tag.json'), true);

        $this->assertEquals($expectedResult, $delete->getMessages());
    }

    /**
     * @test
     */
    public function watchEventReturnsCorrectData()
    {
        $delete = new Watch($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-watch.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-watch.json'), true);

        $this->assertEquals($expectedResult, $delete->getMessages());
    }

    /**
     * @test
     */
    public function deploymentEventReturnsCorrectData()
    {
        $event = new Deployment($this->getDataObjectFromJson(dirname(__FILE__).'/InputData/github-deployment.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__).'/OutputData/github-deployment.json'), true);

        $this->assertEquals($expectedResult, $event->getMessages());
    }

    /**
     * @test
     */
    public function deploymentStatusEventReturnsCorrectData()
    {
        $event = new DeploymentStatus($this->getDataObjectFromJson(dirname(__FILE__) . '/InputData/github-deployment_status.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__) . '/OutputData/github-deployment_status.json'), true);

        $this->assertEquals($expectedResult, $event->getMessages());
    }

    /**
     * @test
     */
    public function forkEventReturnsCorrectData()
    {
        $event = new Fork($this->getDataObjectFromJson(dirname(__FILE__) . '/InputData/github-fork.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__) . '/OutputData/github-fork.json'), true);

        $this->assertEquals($expectedResult, $event->getMessages());
    }

    /**
     * @test
     */
    public function gollumEventReturnsCorrectData()
    {
        $event = new Gollum($this->getDataObjectFromJson(dirname(__FILE__) . '/InputData/github-gollum.json'));
        $expectedResult = json_decode($this->loadFile(dirname(__FILE__) . '/OutputData/github-gollum.json'), true);

        $this->assertEquals($expectedResult, $event->getMessages());
    }

    /**
     * @test
     */
    public function emptyEventTypeShouldThrownError()
    {
        $this->setExpectedException('\InvalidArgumentException');
        new GithubData(array(), array());
    }
}

