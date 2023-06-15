<?php

namespace ClickUp\Objects;

class Folder extends AbstractObject
{
	/* @var int $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var bool $hidden */
	private $hidden;

	/* @var TaskListCollection $taskLists */
	private $taskLists;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * @return bool
	 */
	public function hidden()
	{
		return $this->hidden;
	}

	/**
	 * @return TaskListCollection
	 */
	public function taskLists()
	{
		if (!$this->taskLists) {
			$this->taskLists = new TaskListCollection(
				$this->client(),
				$this->client()->get("folder/{$this->id()}/list")['lists'],
			);
		}

		return $this->taskLists;
	}

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->hidden = isset($array['hidden']) ? $array['hidden'] : false;
	}
}
