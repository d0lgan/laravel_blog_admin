<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the models blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function created(BlogPost $modelsBlogPost)
    {
        //
    }

    public function updating(BlogPost $blogPost) {
        /*$test[] = $blogPost->isDirty();
        $test[] = $blogPost->isDirty('is_published');
        $test[] = $blogPost->isDirty('user_id');
        $test[] = $blogPost->getAttribute('is_published');
        $test[] = $blogPost->is_published;
        $test[] = $blogPost->getOriginal('is_published');
        dd($test);*/

        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }

    protected function setPublishedAt(BlogPost $blogPost) {
        if (empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
    }

    protected function setSlug(BlogPost $blogPost) {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->slug);
        }
    }

    /**
     * Handle the models blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function updated(BlogPost $modelsBlogPost)
    {
        //
    }

    /**
     * Handle the models blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function deleted(BlogPost $modelsBlogPost)
    {
        //
    }

    /**
     * Handle the models blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function restored(BlogPost $modelsBlogPost)
    {
        //
    }

    /**
     * Handle the models blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function forceDeleted(BlogPost $modelsBlogPost)
    {
        //
    }
}
