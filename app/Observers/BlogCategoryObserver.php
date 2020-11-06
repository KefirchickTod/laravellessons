<?php

namespace App\Observers;

use App\Models\BlogCategory;

class BlogCategoryObserver
{


    private function setSlug(BlogCategory $blogCategory){
        if(!$blogCategory->getAttribute('slug')){
            $blogCategory->setAttribute('slug', \Str::slug($blogCategory->title));
        }
    }
    /**
     * Handle the blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * @param BlogCategory $blogCategory
     */
    public function updating(BlogCategory $blogCategory){
        $this->setSlug($blogCategory);
    }

    /**
     * @param BlogCategory $blogCategory
     */
    public function creating(BlogCategory $blogCategory){
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
