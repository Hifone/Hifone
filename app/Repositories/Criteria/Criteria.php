<?php

namespace Hifone\Repositories\Criteria;

use Hifone\Repositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{
    abstract public function apply($model, Repository $repository);
}
