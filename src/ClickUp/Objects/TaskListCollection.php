<?php

namespace ClickUp\Objects;

use ClickUp\Client;

/**
 * @method TaskList   getByKey(int $listId)
 * @method TaskList   getByName(string $listName)
 * @method TaskList[] objects()
 * @method TaskList[] getIterator()
 */
class TaskListCollection extends AbstractObjectCollection
{
	public function __construct(Client $client, $array)
	{
		parent::__construct($client, $array);
	}

	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return TaskList::class;
	}
}
