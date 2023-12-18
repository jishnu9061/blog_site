<?php

namespace App\Http\Controllers\Admin;

use App\Http\Constants\UserConstants;

use App\Services\Admin\HomePageService;

use Illuminate\Http\Request;


class HomeController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }


    public function index(HomePageService $homePageService)
    {
        $registeredActiveUsers = $homePageService->getUsersCount(UserConstants::STATUS_ACTIVE);
        $registeredInActiveUsers = $homePageService->getUsersCount(UserConstants::STATUS_INACTIVE);
        $totalUsers = $homePageService->getUsersCount();
        $adminLoginLogs = $homePageService->getRecentLogins();
        $userRegistrationGraphData = $homePageService->getRegistrationGraphData();
        $registrationGrowthRate = $homePageService->getRegistrationGrowthRate();
        $registeredUsersList = $homePageService->getRegisteredUsersList();
        return $this->renderView($this->getView('index'), compact(
            'registeredActiveUsers',
            'registeredInActiveUsers',
            'userRegistrationGraphData',
            'totalUsers',
            'adminLoginLogs',
            'registrationGrowthRate',
            'registeredUsersList'
        ), 'Home');
    }


}
