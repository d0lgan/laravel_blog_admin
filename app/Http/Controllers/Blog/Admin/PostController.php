<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Blog\BaseController;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    private $blogPostRepository;
    private $blogCategoryRepository;

    public function __construct() {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(25);
        return view('blog.admin.posts.index', compact('paginator'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogPostCreateRequest $request
     * @return Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();
        $item = (new BlogPost())->create($data);

        if ($item) {
           return redirect()
               ->route('blog.admin.posts.edit', [$item->id])
               ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList
            = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)) {
            return back()
                ->withErrors(['msg' => 'Запись с id=[{$id}] не найдена'])
                ->withInput();
        }

        $data = $request->all();

        /* Перенесено в обсервер
        if (empty($data['slug'])) {
          $data['slug'] = Str::slug($data['title']);
        }
        if (empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }*/

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $title = $this->blogPostRepository->getEdit($id)->title;
        $result = BlogPost::destroy($id);


        if ($result) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => 'Запись "' . $title . '" успешно удалена']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
