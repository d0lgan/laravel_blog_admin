<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    // Таблица "blog_categories"
    use SoftDeletes;

    // ID корня
    const ROOT = 1;

    protected $fillable = [
    	'title',
    	'slug',
    	'parent_id',
    	'description'
    ];

    // Получаем родительскую категорию
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    // Аксессор
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
                ? 'Корневая категория'
                : 'Неизвастно');
        return $title;
    }

    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }
}
