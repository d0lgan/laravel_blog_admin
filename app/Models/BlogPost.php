<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
    ];

    /** Категория статьи
	  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	  */
    public function category() {
    	// Статья принадлежит категории
    	return $this->belongsTo(BlogCategory::class);
    }

    /** Автор статьи
	  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	  */
    public function user() {
    	// Статья принадлежит пользователю
    	return $this->belongsTo(User::class);
    }
}
