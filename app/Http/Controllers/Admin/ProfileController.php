<?php

namespace App\Http\Controllers\Admin;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\FileManager;

use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;

use App\Services\Admin\HomePageService;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Toastr;


class ProfileController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('profile');
        $this->addBaseRoute('profile');
    }

    public function index(Request $request)
    {
        $path = $this->getView('profile');
        $para = [];
        $title = 'Edit Profile';

        return $this->renderView($path, $para, $title);
        //  return $this->renderView($this->getView('profile'), [], 'Edit Profile');
    }

    public function viewChangePassword()
    {
        return $this->renderView($this->getView('change-password'), [], 'Change Password');
    }

    public function update(ProfileUpdateRequest $request)
    {

        $admin = Auth::user();
        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
        ]);
        if($request->hasFile('profile_image')) {
            $response = FileManager::upload(FileDestinations::PROFILE_ADMIN,'profile_image' );
            $admin->update([
                'profile_image' => $response['data']['fileName']
            ]);
        }

		 Toastr::success('Profile Updated Successfully');

		return redirect()->route($this->getRoute('index'));
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request['current_password'],$user->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            Toastr::success('Password Updated  Successfully');
        } else {
            Toastr::error('You Entered Wrong Password!!');
        }

        return redirect()->back();
    }

   Public function viewRecentLogin(HomePageService $homePageService)
    {
        $adminLoginLogs = $homePageService->getRecentLogins();

        return $this->renderView($this->getView('recent-login'), compact('adminLoginLogs'), 'Recent Login');
    }
}
