<?php

namespace ClickUp\Objects;

/**
 * @method TimeEntry   getByKey(int $spaceId)
 * @method TimeEntry   getByName(string $spaceName)
 * @method TimeEntry[] objects()
 * @method TimeEntry[] getIterator()
 */
class TimeEntryCollection extends AbstractObjectCollection
{
	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return TimeEntry::class;
	}
}
