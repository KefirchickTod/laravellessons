<?php


namespace App\Repositories;


use App\Models\BlogPost;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{
    const default_paginator = 25;

    protected function getModelClass()
    {
        return BlogPost::class;
    }

    public function getEdit(int $id){
        return $this->startConditions()->find($id);
    }
    /**
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(){
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
            'created_at'
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            //->with(['category', 'user'])
            ->with([
                'user:id,name',
                'category' => function($query){
                    $query->select(['id', 'title']);
                }
            ])
            ->paginate(self::default_paginator);
        return $result;
    }
}
