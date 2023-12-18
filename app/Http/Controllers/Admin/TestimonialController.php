<?php

namespace App\Http\Controllers\Admin;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\ImageUpload;

use App\Models\Testimonial;

use App\Http\Requests\Admin\PageManagement\StoreTestimonialsRequest;
use App\Http\Requests\Admin\PageManagement\UpdateTestimonialsRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Toastr;

class TestimonialController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('page-management.testimonials');
        $this->addBaseRoute('testimonial');
    }

    public function index()
    {
        $this->addBreadcrumb(['Testimonial' => null]);

        $path = $this->getView('index');
        $para = [];
        $title = 'Testimonials List';

        return $this->renderView($path, $para, $title);
    }

    public function create()
    {
        $path = $this->getView('create');
        $para = [];
        $title = 'Create Testimonial';

        return $this->renderView($path, $para, $title);
    }

    public function store(StoreTestimonialsRequest $request)
    {
        $testimonials = Testimonial::create([
            'posted_by' => $request->posted_by,
            'message' => $request->message,
        ]);

        if ($request->has('profile_image')) {
            $res = ImageUpload::upload(FileDestinations::TESTIMONIALS_IMAGE,'profile_image' );
            if ($res['status']) {
                $testimonials['profile_image'] = $res['data']['fileName'];
            }
        }

        $testimonials->save();

        Toastr::success('Testimonial Created Successfully');

        return redirect()->route($this->getRoute('index'));
    }

    public function edit(Testimonial $testimonial)
    {
        $this->addBreadcrumb([
            'Testimonial' => route($this->getRoute('index')),
            'Edit' => null,
        ]);

        $path = $this->getView('edit');
        $para = compact('testimonial');
        $title = 'Edit Testimonial';

        return $this->renderView($path, $para, $title);
    }

    public function update(UpdateTestimonialsRequest $request, Testimonial $testimonial)
    {
        $testimonials = Testimonial::findorFail($testimonial->id);

        if (is_null($testimonials)) {
            return abort(404);
        }

        $testimonials->update([
            'posted_by' => $request->posted_by,
            'message' => $request->message
        ]);

        if ($request->has('profile_image')) {
            $res = ImageUpload::upload(FileDestinations::TESTIMONIALS_IMAGE, 'profile_image');
            if ($res['status']) {
                $testimonials->update([
                    'profile_image' => $res['data']['fileName']
                ]);
            }
        }

        Toastr::success('Testimonial Updated Successfully');

        return redirect()->route($this->getRoute('index'));
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return Response::json(['success' => 'Testimonial Deleted Successfully']);
    }

    public function getTestimonials()
    {
        try {
            $data = Testimonial::all();

            return response()->json($data);

        } catch (\Exception $e) {
            // Log the exception
            \Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

    }
}
?>
