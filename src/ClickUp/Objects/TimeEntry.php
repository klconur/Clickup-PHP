<?php

namespace ClickUp\Objects;

class TimeEntry extends AbstractObject
{
	/* @var string $id*/
	private $id;
	private $task;
	private $wid;
	private $user;
	private $billable;
	private $start;
	private $end;
	private $duration;
	private $description;
	private $tags;
	private $source;
	private $at;
	private $task_location;
	private $task_tags;
	private $task_url;
	private $space;
	private $space_id;
	private $folder_id;
	private $folder;
	private $list_id;
	private $list;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}
	public function wid()
	{
		return $this->wid;
	}
	public function user()
	{
		return $this->user;
	}
	public function billable()
	{
		return $this->billable;
	}
	public function start()
	{
		return $this->start;
	}
	public function end()
	{
		return $this->end;
	}
	public function duration()
	{
		return $this->duration;
	}
	public function description()
	{
		return $this->description;
	}
	// public function tags()
	// {
	//  return $this->tags;
	// }
	public function source()
	{
		return $this->source;
	}
	public function at()
	{
		return $this->at;
	}
	public function task_location()
	{
		return $this->task_location;
	}
	public function tags()
	{
		return $this->tags;
	}
	public function task_tags()
	{
		return $this->task_tags;
	}
	public function task_url()
	{
		return $this->task_url;
	}

	public function space_id()
	{
		return $this->space_id;
	}

	public function space()
	{
		if (is_null($this->space) && $this->space_id()) {
			$this->space = new Space(
				$this->client(),
				$this->client()->get("space/{$this->space_id()}")
			);
		}

		return $this->space;
	}

	public function folder()
	{
		if (is_null($this->folder) && $this->folder_id) {
			$this->folder = new Folder(
				$this->client(),
				$this->client()->get("folder/{$this->folder_id}")
			);
		}

		return $this->folder;
	}

	public function listId()
	{
		return $this->list_id;
	}

	public function list()
	{
		if (is_null($this->list) && $this->list_id) {
			$this->list = new TaskList(
				$this->client(),
				$this->client()->get("list/{$this->list_id}")
			);
		}

		return $this->list;
	}

	public function task()
	{
		if (is_null($this->task) && $this->task_id) {
			$this->task = new Task(
				$this->client(),
				$this->client()->get("task/{$this->task_id}")
			);
		}

		return $this->task;
	}

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->task_id = isset($array['task']['id']) ? $array['task']['id'] : null;
		$this->wid = $array['wid'];
		$this->user = new User(
			$this->client(),
			$array['user']
		);
		$this->task = isset($array['task']['id']) ? new Task(
			$this->client(),
			$array['task']
		) : null;
		$this->billable = $array['billable'];
		$this->start = $this->getDate($array, 'start');
		$this->end = $this->getDate($array, 'end');
		$this->duration = $array['duration'];
		$this->description = $array['description'];
		$this->tags = $array['tags'];
		$this->source = $array['source'];
		$this->at = $this->getDate($array, 'at');
		$this->task_location = isset($array['task_location']) ? $array['task_location'] : null;
		$this->space_id = isset($array['task_location']['space_id']) ? $array['task_location']['space_id'] : null;
		$this->folder_id = isset($array['task_location']['folder_id']) ? $array['task_location']['folder_id'] : null;
		$this->list_id = isset($array['task_location']['list_id']) ? $array['task_location']['list_id'] : null;
		$this->space = isset($array['task_location']['space_id']) ? new Space(
			$this->client(),
			[
				'id' => $array['task_location']['space_id'],
				'name' => isset($array['task_location']['space_name']) ? $array['task_location']['space_name'] : null,
			]
		) : null;
		$this->folder = isset($array['task_location']['folder_id']) ? new Folder(
			$this->client(),
			[
				'id' => $array['task_location']['folder_id'],
				'name' => isset($array['task_location']['folder_name']) ? $array['task_location']['folder_name'] : null,
			]
		) : null;
		$this->list = isset($array['task_location']['list_id']) ? new TaskList(
			$this->client(),
			[
				'id' => $array['task_location']['list_id'],
				'name' => isset($array['task_location']['list_name']) ? $array['task_location']['list_name'] : null,
			]
		) : null;
		$this->task_tags = $array['task_tags'] ?? [];
		$this->task_url = isset($array['task_url']) ? $array['task_url'] : null;
	}

	/**
	 * @param $array
	 * @param $key
	 * @return \DateTimeImmutable|null
	 * @throws \Exception
	 */
	private function getDate($array, $key)
	{
		if(!isset($array[$key])) {
			return null;
		}
		$unixTime = substr($array[$key], 0, 10);
		return new \DateTimeImmutable("@$unixTime");
	}
}
