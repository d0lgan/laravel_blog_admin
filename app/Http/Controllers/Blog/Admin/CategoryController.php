<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Http\Controllers\Blog\BaseController;
use Illuminate\Support\Str;

// Управление категориями блога
class CategoryController extends BaseController
{

    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paginator = BlogCategory::paginate();
        $paginator = $this->blogCategoryRepository->getAllWithPaginate();
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
                compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
         $data = $request->input();

         /* Ушло в обсервер
         if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
         }*/

         // 2 способа сохранения категории
         /* $item = new BlogCategory($data);
         $item->save(); */
         $item = (new BlogCategory())->create($data);

         if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
         } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $item = BlogCategory::findOrFail($id);
        // $categoryList = BlogCategory::all();

        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        // Задаем правила
        /*$rules = [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200',
            'description' => 'string|max:200|min:3',
            'parent_id' => 'required|integer|exists:blog_categories,id',
        ];*/

        // $validatedData = $this->validate($request, $rules);
        // $validatedData = $request->validate($rules);

        /*$validator = \Validator::make($request->all(), $rules);
        $validatedData[] = $validator->passes();
        $validatedData[] = $validator->validate();
        $validatedData[] = $validator->valid();
        $validatedData[] = $validator->failed();
        $validatedData[] = $validator->errors();
        $validatedData[] = $validator->fails();*/


        // dd($validatedData);


        // Запись с id = $id (если её нет возвращается null)
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
                    ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                    ->withInput();
        }

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
         }

        $result = $item->fill($data)->save();
        if ($result) {
            return redirect()
                    ->route('blog.admin.categories.edit', $item->id)
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
