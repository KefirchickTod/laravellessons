<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends \App\Http\Controllers\Blog\Admin\BaseController
{

    private $blogCategoryRepository;

    public function __construct()
    {
        // $this->middleware('auth'); //only for login users
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginator(5);
        return view('blog.admin.categories.index', compact('paginator'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryCreateRequest$request
     * @return mixed
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = \Str::slug($data['title']);
        }
        $item = new BlogCategory($data);
        $item->save();
        if($item->exists){
            return redirect()->route('blog.admin.categories.edit', $item->id)->with(['success' => 'Success saved']);
        }
        return back()->withErrors(['msg' => 'Erroro saved'])->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }


    /**
     * @param BlogCategoryUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//        $id = 1111;

//        $rules = [
//            'title' => 'required|min:5|max:200',
//            'slug' => 'max:200',
//            'description' => 'string|max:500|min:3',
//            'parent_id' => 'required|integer|exists:blog_categories,id'
//        ];
//
//        $validatedData = $this->validate($request, $rules);
//
//        dd($validatedData);

        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Category #$id not found"])->withInput();
        }
        $data = $request->all();
       // dd($data);
        $result = $item->fill($data)->save();
        if($result){
            return  redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Success saved']);
        }else{
            return back()
                ->withErrors(['msg' => 'Error saved'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
