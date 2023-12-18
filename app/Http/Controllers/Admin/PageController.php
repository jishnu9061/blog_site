<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;

use App\Http\Requests\Admin\PageManagement\StorePageRequest;
use App\Http\Requests\Admin\PageManagement\UpdatePageRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Toastr;

class PageController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('page-management');
        $this->addBaseRoute('page');
    }

    public function index()
    {
        $this->addBreadcrumb(['Page' => null]);
        $path = $this->getView('index');
        $para = [];
        $title = 'Page List';

        return $this->renderView($path, $para, $title);

    }


    public function create()
    {
        $path = $this->getView('create');
        $para = [];
        $title = 'Create Page';

        return $this->renderView($path, $para, $title);
    }


    public function store(StorePageRequest $request)
    {
        $page = Page::create([
            'name' => $request->title,
            'description' => $request->description,
        ]);

        $page->save();

        Toastr::success('Page Created Successfully');

        return redirect()->route($this->getRoute('index'));
    }


    public function edit(Page $page)
    {
        $this->addBreadcrumb([
            'Page' => route($this->getRoute('index')),
            'Edit' => null,
        ]);

        $path = $this->getView('modules.home');
        $para = compact('page');
        $title = 'Edit Page';

        return $this->renderView($path, $para, $title);
    }


    public function update(UpdatePageRequest $request, Page $page)
    {
        $updatedPage = Page::findorFail($page->id);

        if (!$updatedPage) {

            return abort(404);
        }
        $updatedPage->update([
            'name' => $request->title,
            'description' => $request->description,
            'status'=> $request->status,
        ]);

        Toastr::success('Page Updated Successfully');

        return redirect()->route('admin.page.index');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return Response::json(['success' => 'Page Deleted Successfully']);
    }


    public function getPage()
    {
        try {
            $data = page::all();

            return response()->json($data);

        } catch (\Exception $e) {
            // Log the exception
            \Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

}
