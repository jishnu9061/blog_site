<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Constants\PageConstants;

use App\Models\Category;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('admin.category');
        $this->addBaseView('admin.category');
    }

    /**
     * Show All Category
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $path = $this->getView('index');
        $categories = Category::paginate(PageConstants::PAGINATE);
        $title = 'Category';
        return $this->renderView($path, ['categories' => $categories], $title);
    }

    /**
     * Create Category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $path = $this->getView('create');
        $title = 'Create Category';
        return $this->renderView($path, [], $title);
    }

    /**
     * Store Category
     *
     * @param CategoryStoreRequest $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(CategoryStoreRequest $request)
    {
        Category::create([
            'category_name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Category Created Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Edit Category
     *
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Category $category)
    {
        $path = $this->getView('edit');
        $title = 'Edit Suite Amenities';
        return $this->renderView($path, ['category' => $category], $title);
    }

    /**
     * Update Category
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update([
            'category_name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Category Updated Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Delete Category
     *
     * @param Category $category
     *
     *  @return \Illuminate\Support\Facades\Response|\Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Toastr::success('Category Deleted Successfully');
        return Response::json(['success' => 'Category Deleted Successfully']);
    }
}
