<?php

namespace App\Http\Controllers\User;

use App\Services\User\HomePageService;

use Illuminate\Http\Request;

class HomeController extends BaseController
{

    /**
     * HomeController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }

    /**
     * Show the application dashboard.
     *
     * @param HomePageService $homePageService
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomePageService $homePageService)
    {
        $userLoginLogs = $homePageService->getRecentLogins();
        return $this->renderView($this->getView('index'), compact('userLoginLogs' ), 'Home');
    }

}
