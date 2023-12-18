<?php

namespace App\Http\Controllers\Web;


use App\Models\ContactUs;

use App\Http\Requests\Web\ContactUs\ContactUsStoreRequest;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Toastr;

class ContactUsController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('contact-us');
        $this->addBaseView('contact-us');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->renderView($this->getView('index'), [], 'Home');
    }

    public function support(ContactUsStoreRequest $request)
    {
        $service = ContactUs::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messages' => $request->messages,
        ]);
        Toastr::success('Support Ticket Added Successfully');
        return redirect()->route($this->getRoute(''));
    }

}
