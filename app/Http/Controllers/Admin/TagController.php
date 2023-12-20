<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Constants\PageConstants;

use App\Models\Tag;
use App\Models\Category;

use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TagController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('admin.tag');
        $this->addBaseView('admin.tag');
    }

    /**
     * Show All Tags
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $path = $this->getView('index');
        $tags = Tag::paginate(PageConstants::PAGINATE);
        $title = 'Tag';
        return $this->renderView($path, ['tags'=>$tags], $title);
    }

    /**
     * Create Tag
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $path = $this->getView('create');
        $title = 'Create Tag';
        return $this->renderView($path, [], $title);
    }

    /**
     * Store Tag
     *
     * @param TagStoreRequest $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(TagStoreRequest $request)
    {
         Tag::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Tag Created Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Edit Tag
     *
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Tag $tag)
    {
        $path = $this->getView('edit');
        $title = 'Edit Tag';
        return $this->renderView($path, ['tag'=>$tag], $title);
    }

    /**
     * Update Tag
     *
     * @param TagUpdateRequest $request
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(TagUpdateRequest $request,Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        Toastr::success('Tag Updated Successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Delete Tag
     *
     * @param Tag $tag
     *
     * @return \Illuminate\Support\Facades\Response|\Illuminate\Http\JsonResponse
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        Toastr::success('Tag Deleted Successfully');
        return Response::json(['success' => 'Tag Deleted Successfully']);
    }
}
