<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\Tag;

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
        $categories = Tag::paginate(PageConstants::PAGINATE);
        $title = 'Tag';
        return $this->renderView($path, ['tags'=>$categories], $title);
    }

    public function create()
    {
        $path = $this->getView('create');
        $title = 'Create Tag';
        return $this->renderView($path, [], $title);
    }

    public function store(TagStoreRequest $request)
    {
         Tag::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Category Created Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    public function edit(Tag $tag)
    {
        $path = $this->getView('edit');
        $title = 'Edit Suite Amenities';
        return $this->renderView($path, ['tag'=>$tag], $title);
    }

    public function update(TagUpdateRequest $request,Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Category Updated Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        Toastr::success('Category Deleted Successfully');
        return Response::json(['success' => 'Category Deleted Successfully']);
    }
}
