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
	// private $task_tags;
	private $task_url;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}
	public function task()
	{
		return $this->task;
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
	// 	return $this->tags;
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
	public function task_tags()
	{
		return $this->task_tags;
	}
	public function task_url()
	{
		return $this->task_url;
	}

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->task = $array['task'];
		$this->wid = $array['wid'];
		$this->user = $array['user'];
		$this->billable = $array['billable'];
		$this->start = $array['start'];
		$this->end = $array['end'];
		$this->duration = $array['duration'];
		$this->description = $array['description'];
		$this->tags = $array['tags'];
		$this->source = $array['source'];
		$this->at = $array['at'];
		$this->task_location = $array['task_location'];
		// $this->task_tags = $array['task_tags'];
		$this->task_url = $array['task_url'];
	}
}
