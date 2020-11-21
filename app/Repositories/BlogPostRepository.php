<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\CoreRepository;
use App\Models\BlogPost;

class BlogPostRepository extends CoreRepository
{
	public function __construct() {
		parent::__construct(new BlogPost());
	}

	protected function getModelClass() {
		return Model::class;
	}

	// Получить список всех статей
	// @return LengthAwarePaginator
	public function getAllWithPaginate($perPage = null) {
		$columns = ['id', 'title', 'slug', 'is_published',
		 'published_at', 'user_id', 'category_id'];

		$result = $this
			->startConditions()
			->select($columns)
			->orderBy('id', 'DESC')
			//->with(['category', 'user'])
			->with([
				// 	Первый вариант
				'category' => function ($query) {
					$query->select(['id', 'title']);
				},

				'user' => function ($query) {
					$query->select(['id', 'name']);
				}
				/*	Второй вариант
				'category:id,title',
				'user:id,name'*/
			])
			->paginate($perPage);
		return $result;
	}

	// Получить модель для редактирования в админке
	public function getEdit($id) {
		return $this->startConditions()->find($id);
	}

	// Получить список категорий для вывода в выпадющем спске
	public function getForComboBox() {
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
}
