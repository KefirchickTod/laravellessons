<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{
    /**
     * Handle the blog post "creating" event.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setUserId($blogPost);

        $this->setContentHtml($blogPost);
    }

    private function setUserId(BlogPost $blogPost){
        if(!$blogPost->user_id){
            $blogPost->setAttribute('user_id', 1);
        }
    }

    private function setContentHtml(BlogPost $blogPost){
        if(!$blogPost->content_html){
            $blogPost->setAttribute('content_html', $blogPost->content_raw);
        }
    }

    /**
     * Handle the blog post "updating" event.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
        //dd('test');
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    /**
     *
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        if (empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->setAttribute('published_at', Carbon::now());
        }
    }

    /**
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost)
    {

        if (empty($blogPost->slug) && $blogPost->title) {
            $blogPost->setAttribute('slug', \Str::slug($blogPost->title));
        }
    }
}
