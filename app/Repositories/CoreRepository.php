<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;

/*	Репозиторий работы с сущностью.
	Может выдавать наборы данных.
	Не может создавать/изменять сущности.*/

abstract class CoreRepository
{
	protected $model;

	// params: Model's Class
	public function __construct($model) {
		$this->model = $model;
	}

	protected function startConditions()
	{
		return clone $this->model;
	}
}
