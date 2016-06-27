<?php

namespace Hifone\Repositories\Criteria;

use Hifone\Repositories\Contracts\RepositoryInterface as Repository;


class OnlyMine extends Criteria
{
	/**
	* @var int
	*/
	protected $userId;


	public function __construct($userId)
	{
		$this->userId = $userId;
	}

	public function apply($model, Repository $repository)
	{
		return $model->forUser($this->userId);
	}
}