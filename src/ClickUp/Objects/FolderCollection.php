<?php

namespace ClickUp\Objects;

use ClickUp\Client;

/**
 * @method Folder   getByKey(int $folderId)
 * @method Folder   getByName(string $folderName)
 * @method Folder[] objects()
 * @method Folder[] getIterator()
 */
class FolderCollection extends AbstractObjectCollection
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
		return Folder::class;
	}
}
