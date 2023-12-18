<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth:admin');
        $this->_view = 'pages.admin.';
        $this->addBaseRoute('admin.');
    }
}
