<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\CoreRepository;
use App\Models\BlogCategory;

class BlogCategoryRepository extends CoreRepository
{
	public function __construct() {
		parent::__construct(new BlogCategory());
	}

	protected function getModelClass() {
		return Model::class;
	}

	// Получить модель для редактирования в админке
	public function getEdit($id) {
		return $this->startConditions()->find($id);
	}

	// Получить список категорий для вывода в выпадющем спске
	public function getFromComboBox() {
		$columns = implode(', ', [
			'id',
			'CONCAT (id, ". ", title) AS id_title'
		]);
		$result = $this
			->startConditions()
			->selectRaw($columns)
			->toBase()
			->get();

		/* Второй вариант:
		$result = $this
			->startConditions()
			->select('blog_categories.*',
				\DB::raw('CONCAT (id, ". ", title) AS id_title'))
			->toBase()
			->get();*/

		return $result;
	}

	public function getAllWithPaginate($perPage = null) {
		$columns = ['id', 'title', 'parent_id'];

		$result = $this
			->startConditions()
			->select($columns)
			->paginate($perPage);

		return $result;
	}
}
