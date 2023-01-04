<?php

namespace ClickUp\Objects;

class Task extends AbstractObject
{
	use TaskFinderTrait;

	/* @var string $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var string $description */
	private $description;

	/* @var string $textContent */
	private $textContent;

	/* @var Status $status */
	private $status;

	/* @var string $orderindex */
	private $orderindex;

	/* @var \DateTimeImmutable $dateCreated */
	private $dateCreated;

	/* @var \DateTimeImmutable $dateUpdated */
	private $dateUpdated;

	/* @var \DateTimeImmutable $dateClosed */
	private $dateClosed;

	/* @var TeamMember $creator */
	private $creator;

	/* @var TeamMemberCollection $assignees */
	private $assignees;

	/* @var array $tags */
	private $tags;

	/* @var array $customFields */
	private $customFields;

	/* @var string|null $customId */
	private $customId;

	/* @var string|null $parentTaskId */
	private $parentTaskId;

	/* @var Task|null $parentTask */
	private $parentTask = null;

	/* @var string $priority */
	private ?string $priority;

	/* @var \DateTimeImmutable $dueDate */
	private $dueDate;

	/* @var \DateTimeImmutable $startDate */
	private $startDate;

	/* @var int $points */
	private $points;

	/* @var string $timeEstimate */
	private $timeEstimate;

	/* @var string $timeSpent */
	private $timeSpent;

	/* @var int $listId */
	private $listId;

	/* @var TaskList|null $list */
	private $list = null;

	/* @var int $folderId */
	private $folderId;

	/* @var Folder|null $folder */
	private $folder;

	/* @var int $projectId */
	private $projectId;

	/* @var Project|null $project */
	private $project = null;

	/* @var int $spaceId */
	private $spaceId;

	/* @var Space|null $space */
	private $space = null;

	/* @var int $teamId */
	private $teamId;

	/* @var Team|null $team */
	private $team = null;

	/* @var string $url */
	private $url;

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

	public function url()
	{
		return $this->url;
	}

	public function description()
	{
		return $this->description;
	}

	public function textContent()
	{
		return $this->textContent;
	}

	public function status()
	{
		return $this->status;
	}

	public function orderindex()
	{
		return $this->orderindex;
	}

	public function dateCreated()
	{
		return $this->dateCreated;
	}

	public function dateUpdated()
	{
		return $this->dateUpdated;
	}

	public function dateClosed()
	{
		return $this->dateClosed;
	}

	public function creator()
	{
		return $this->creator;
	}

	public function assignees()
	{
		return $this->assignees;
	}

	public function tags()
	{
		return $this->tags;
	}

	public function customFields()
	{
		return $this->customFields;
	}

	public function customId()
	{
		return $this->customId;
	}

	public function parentTaskId()
	{
		return $this->parentTaskId;
	}

	public function isSubTask()
	{
		return !is_null($this->parentTaskId());
	}

	/**
	 * @return Task|null
	 */
	public function parentTask()
	{
		if (is_null($this->parentTaskId())) {
			return null;
		}
		if (is_null($this->parentTask)) {
			$this->parentTask = $this
				->tasks()
				->getByTaskId($this->parentTaskId());
		}
		return $this->parentTask;
	}

	public function priority()
	{
		return $this->priority;
	}

	public function dueDate()
	{
		return $this->dueDate;
	}

	public function startDate()
	{
		return $this->startDate;
	}

	public function points()
	{
		return $this->points;
	}

	public function timeEstimate()
	{
		return $this->timeEstimate;
	}

	public function timeSpent()
	{
		return $this->timeSpent;
	}

	public function projectId()
	{
		return $this->projectId;
	}

	/**
	 * @return Project
	 */
	public function project()
	{
		if (is_null($this->project)) {
			$this->project = $this->space()->project($this->projectId());
		}
		return $this->project;
	}

	/**
	 * @return int
	 */
	public function spaceId()
	{
		return $this->spaceId;
	}

	/**
	 * @return Space
	 */
	public function space()
	{
		if (is_null($this->space)) {
			$this->space = $this->team()->space($this->spaceId());
		}
		return $this->space;
	}

	/**
	 * @return int
	 */
	public function folderId()
	{
		return $this->folderId;
	}

	public function folder()
	{
		if (is_null($this->folder) && $this->folderId) {
			$this->folder = $this->client()->folder($this->folderId());
		}
		return $this->folder;
	}

	public function taskListId()
	{
		return $this->listId;
	}

	public function taskList()
	{
		return $this->list();
	}

	/**
	 * @return int
	 */
	public function listId()
	{
		return $this->listId;
	}

	public function list()
	{
		if (is_null($this->list) && $this->listId) {
			$this->list = $this->client()->list($this->listId());
		}
		return $this->list;
	}

	public function teamId()
	{
		return $this->teamId;
	}

	public function setTeamId($teamId)
	{
		$this->teamId = $teamId;
	}

	/**
	 * @return Team
	 */
	public function team()
	{
		if (is_null($this->team)) {
			$this->team = $this->client()->team($this->teamId());
		}
		return $this->team;
	}

	/**
	 * @see https://jsapi.apiary.io/apis/clickup/reference/0/task/edit-task.html
	 * @param array $body
	 * @return array
	 */
	public function edit($body)
	{
		return $this->client()->put(
			"task/{$this->id()}",
			$body
		);
	}

	/**
	 * @param $array
	 * @throws \Exception
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->description = isset($array['description']) ? (string) $array['description'] : '';
		$this->textContent = isset($array['text_content']) ? (string) $array['text_content'] : '';
		$this->status = isset($array['status']) ? new Status(
			$this->client(),
			$array['status']
		) : null;
		$this->orderindex = isset($array['orderindex']) ? $array['orderindex'] : null;
		$this->dateCreated = $this->getDate($array, 'date_created');
		$this->dateUpdated = $this->getDate($array, 'date_updated');
		$this->dateClosed = $this->getDate($array, 'date_closed');
		$this->creator = isset($array['creator']) ? new User(
			$this->client(),
			$array['creator']
		) : null;
		$this->assignees = isset($array['assignees']) ? new UserCollection(
			$this->client(),
			$array['assignees']
		) : null;

		// TODO TagCollection
		$this->tags = isset($array['tags']) ? $array['tags'] : null;
		$this->customFields = isset($array['custom_fields']) ? $array['custom_fields'] : null;
		$this->customId = isset($array['custom_id']) ? $array['custom_id'] : null;
		$this->parentTaskId = isset($array['parent']) ? $array['parent'] : null;
		$this->priority = isset($array['priority']['priority']) ? $array['priority']['priority'] : null;
		$this->dueDate = $this->getDate($array, 'due_date');
		$this->startDate = $this->getDate($array, 'start_date');
		$this->points = isset($array['point']) ? $array['point'] : null;
		$this->timeEstimate = isset($array['time_estimate']) ? $array['time_estimate'] : null;
		$this->timeSpent = isset($array['time_spent']) ? $array['time_spent'] : null;
		$this->listId = isset($array['list']['id']) ? $array['list']['id'] : null;
		$this->list = isset($array['list']) ? new TaskList(
			$this->client(),
			$array['list']
		) : null;
		$this->projectId = isset($array['project']['id']) ? $array['project']['id'] : null;
		$this->project = isset($array['project']) ? new Project(
			$this->client(),
			$array['project']
		) : null;
		$this->folderId = isset($array['folder']['id']) ? $array['folder']['id'] : null;
		$this->folder = isset($array['folder']) ? new Folder(
			$this->client(),
			$array['folder']
		) : null;
		$this->spaceId = isset($array['space']['id']) ? $array['space']['id'] : null;
		$this->space = isset($array['space']) ? new Space(
			$this->client(),
			$array['space']
		) : null;
		$this->url = isset($array['url']) ? $array['url'] : null;
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
