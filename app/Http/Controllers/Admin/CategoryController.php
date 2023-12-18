<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Constants\PageConstants;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('admin.category');
        $this->addBaseView('admin.category');
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

    public function store(CategoryStoreRequest $request)
    {
        $suiteType = Category::create([
            'category_name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Suite Amenities Created Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    public function edit($id)
    {
        $path = $this->getView('edit');
        $title = 'Edit Suite Amenities';
        return $this->renderView($path, ['amenities' => Amenities::find($id)], $title);
    }

    public function update(SuiteAmenitiesUpdateRequest $request, $id)
    {
        $updatedsuiteAmenities = Amenities::findorFail($id);
        $updatedsuiteAmenities->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $updatedsuiteAmenities->save();
        Toastr::success('Suite Amenities Updated Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    public function destroy($id)
    {
        $deleteSuiteAmenities = Amenities::findorFail($id);
        $deleteSuiteAmenities->delete();
        return Response::json(['success' => 'Suite Amenities Deleted Successfully']);
    }

}
