<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    public function setSlug(BlogCategory $blogCategory) {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }
    /**
     * Handle the models blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    public function creating(BlogCategory $blogCategory) {
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the models blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    public function updating(BlogCategory $blogCategory) {
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the models blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the models blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the models blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
