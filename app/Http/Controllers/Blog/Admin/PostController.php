<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostAfterCreateJop;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends BaseController
{

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        // dd($items);
        return view('blog.admin.posts.index', compact('paginator'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComBox();
        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * @param BlogPostCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();
        //  dd($data);
        $item = (new BlogPost())->create($data);
        if ($item) {
            $job = new BlogPostAfterCreateJop($item);
            $this->dispatch($job);
            return redirect()->route('blog.admin.post.edit', $item->id)->with(['success' => 'Success saved']);
        }
        return back()
            ->withInput()
            ->withErrors(['msg' => 'Error with create of post']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));

    }


    /**
     * @param BlogPostUpdateRequest|\Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        /** @var  $item BlogPost */
        $item = $this->blogPostRepository->getEdit(intval($id));
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Not found $id"])
                ->withInput();
        }
        $data = $request->all();
//        if(empty($data['slug'])){
//            $data['slug'] = \Str::slug($data['title']);
//        }
//        if(empty($item->published_at) && $data['is_published']){
//            $data['published_at'] = Carbon::now();
//        }

        $result = $item->update($data);
        if ($result) {
            return redirect()
                ->route('blog.admin.post.edit', $item->id)
                ->with(['success' => 'Success saved']);
        }
        return back()->
        withErrors(['msg' => 'Error with save'])
            ->withInput();


    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = BlogPost::destroy(intval($id));

        if ($result) {
            return redirect()->route('blog.admin.post.index')->with(['success' => 'Delete note nub ' . $id]);
        }
        return back()->withErrors(['msg' => 'Cant delete '.$id]);
    }
}
