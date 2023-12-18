<?php

namespace App\Http\Controllers;

use Toastr;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Constants\PageConstants;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class TagController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('admin.tag');
        $this->addBaseView('admin.tag');
    }

    public function index(Request $request)
    {
        $path = $this->getView('index');
        $categories = Category::paginate(PageConstants::PAGINATE);
        $title = 'Category';
        return $this->renderView($path, ['categories'=>$categories], $title);
    }

    public function create()
    {
        $path = $this->getView('create');
        $title = 'Create Category';
        return $this->renderView($path, [], $title);
    }

    public function store(TagStoreRequest $request)
    {
         Category::create([
            'category_name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Category Created Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    public function edit(Category $category)
    {
        $path = $this->getView('edit');
        $title = 'Edit Suite Amenities';
        return $this->renderView($path, ['category'=>$category], $title);
    }

    public function update(TagUpdateRequest $request,Category $category)
    {
        $category->update([
            'category_name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Category Updated Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Toastr::success('Category Deleted Successfully');
        return Response::json(['success' => 'Category Deleted Successfully']);
    }
}
