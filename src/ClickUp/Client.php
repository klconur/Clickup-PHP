<?php

namespace ClickUp;

use ClickUp\Objects\TaskCollection;
use ClickUp\Objects\TaskFinder;
use ClickUp\Objects\Team;
use ClickUp\Objects\TaskList;
use ClickUp\Objects\TeamCollection;
use ClickUp\Objects\User;
use ClickUp\Objects\Space;
use ClickUp\Objects\Task;

class Client
{
	private $guzzleClient;

	public function __construct($apiToken, $client = null)
	{
		$this->guzzleClient = $client ?: new \GuzzleHttp\Client([
			'base_uri' => 'https://api.clickup.com/api/v2/',
			'headers' => [
				'Authorization' => $apiToken,
			]
		]);
	}

	public function client()
	{
		return $this;
	}

	/**
	 * @return User
	 */
	public function user()
	{
		return new User(
			$this,
			$this->get('user')['user']
		);
	}

	/**
	 * @return TeamCollection
	 */
	public function teams()
	{
		return new TeamCollection(
			$this,
			$this->get('team')['teams']
		);
	}

	/**
	 * @param int $teamId
	 * @return Team
	 */
	public function team($teamId)
	{
		return new Team(
			$this,
			$this->get("team/$teamId")['team']
		);
	}

	/**
	 * @param int $taskId
	 * @return Task
	 */
	public function task($taskId)
	{
		return new Task(
			$this,
			$this->get("task/$taskId")['task']
		);
	}

	/**
	 * @param int $spaceId
	 * @return Space
	 */
	public function space($spaceId)
	{
		return new Space(
			$this,
			$this->get("space/$spaceId")['space']
		);
	}

	/**
	 * @param int $listId
	 * @param array $params
	 * @return TaskCollection
	 */
	public function tasks($listId, $params)
	{
		return new TaskCollection(
			$this,
			$this->get("list/$listId/task", $params)['tasks']
		);
	}

	/**
	 * @param int $listId
	 * @return List
	 */
	public function list($listId)
	{
		return new TaskList(
			$this,
			$this->get("list/$listId")['list']
		);
	}

	/**
	 * @param int $teamId
	 * @return TaskFinder
	 */
	public function taskFinder($teamId)
	{
		return new TaskFinder($this, $teamId);
	}

	/**
	 * @param string $method
	 * @param array  $params
	 * @return mixed
	 */
	public function get($uri, $params = [])
	{
		$response = $this->guzzleClient->request('GET', $uri, ['query' => $params]);
		return \GuzzleHttp\json_decode($response->getBody(), true);
	}

	/**
	 * @param string $method
	 * @param array $body
	 * @return mixed
	 */
	public function post($method, $body = [])
	{
		//echo "<br>------POST STARTED--------<br>";
		//echo $method;
		try {
			//$result = $this->guzzleClient->request('POST', $method, ['json' => $body]);
			$result = \GuzzleHttp\json_decode($this->guzzleClient->request('POST', $method, ['json' => $body], ['debug' => true])->getBody(), true);
			//var_dump($result);
			//echo "<br>------------------";
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody()->getContents();
			$this->var_error_log("<br>------------------");
			$this->var_error_log($response);
			$this->var_error_log("<br>------------------");
			$this->var_error_log($responseBodyAsString);
		}
		return $result;
	}

	private function var_error_log($object = null)
	{
		ob_start();                    // start buffer capture
		var_dump($object);           // dump the values
		$contents = ob_get_contents(); // put the buffer into a variable
		ob_end_clean();                // end capture
		error_log($contents);        // log contents of the result of var_dump( $object )
	}

	/**
	 * @param string $method
	 * @param array $body
	 * @return mixed
	 */
	public function put($method, $body = [])
	{
		$result = \GuzzleHttp\json_decode($this->guzzleClient->request('PUT', $method, ['json' => $body])->getBody(), true);
		//var_dump($result);
		//echo "<br>------------------";
		return $result;
	}
}
