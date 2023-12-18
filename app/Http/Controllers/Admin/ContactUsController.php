<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('contact-us');
        $this->addBaseView('contact-us');
    }

    public function index(Request $request)
    {
        $path = $this->getView('index');
        $para = [];
        $title = 'Contact Us Requests';

        return $this->renderView($path, $para, $title);
    }

    public function message(ContactUs $contactUs)
    {
        $userMessage =  DB::table(ContactUs::getTableName())
        ->select('messages')
        ->where('id', $contactUs->id)
        ->first();

        return response()->json($userMessage);
    }

    public function getMessages()
    {
        try {
            $data = ContactUs::all();

            return response()->json($data);

        } catch (\Exception $e) {
            // Log the exception
            \Log::error($e);

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
