<?php


namespace App\Repositories;


use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */
class BlogCategoryRepository  extends CoreRepository
{



    protected function getModelClass(){
        return BlogCategory::class;
    }

    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    /**
     * @param null $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginator($perPage = null, $columns = []){
        $columns = $columns  ?: ['id', 'title', 'parent_id'];

        $result =  $this->startConditions()
            ->select($columns)
            ->paginate($perPage);
        return  $result;
    }

    public function getForComBox(){

        $columns = join(', ',[
                'id',
            'CONCAT (id, ". ", title) AS title'
            ]);

        //$result[] = $this->startConditions()->all();


        $result[] = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
      //  dd($result);
        return $this->startConditions()->all();
    }


}
