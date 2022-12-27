<?php

namespace ClickUp\Objects;

class Folder extends AbstractObject
{
	/* @var int $id*/
	private $id;

	/* @var string $name */
	private $name;

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
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
	}
}
