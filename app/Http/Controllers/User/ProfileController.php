<?php

namespace App\Http\Controllers\User;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\FileManager;
use App\Http\Helpers\Core\ImageUpload;

use App\Http\Requests\User\PasswordUpdateRequest;
use App\Http\Requests\User\ProfileImageUpdateRequest;
use App\Http\Requests\User\ProfileUpdateRequest;

use App\Services\User\HomePageService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Toastr;


class ProfileController extends BaseController
{

    /**
     * ProfileController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('profile');
        $this->addBaseRoute('profile');
    }

    /**
     * Show profile edit page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->renderView($this->getView('profile'), [], 'Profile');
    }

    /**
     * Show form to change password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewChangePassword()
    {
        return $this->renderView($this->getView('change-password'), [], 'Change Password');
    }

    /**
     * @param HomePageService $homePageService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function viewRecentLogin(HomePageService $homePageService)
    {
        $userLoginLogs = $homePageService->getRecentLogins();
        return $this->renderView($this->getView('recent-login'), compact('userLoginLogs'), 'Recent Login');
    }

    /**
     * Update profile
     *
     * @param ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        if($request->hasFile('profile_image')) {
            $response = FileManager::upload(FileDestinations::PROFILE_USER,'profile_image' );
            $user->update([
                'profile_image' => $response['data']['fileName']
            ]);
        }

        Toastr::success('profile updated successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Update password
     *
     * @param PasswordUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request['current_password'],$user->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            Toastr::success('Password updated  successfully');
        } else {
            Toastr::error('You entered wrong password!!');
        }
        return redirect()->back();
    }

    /**
     * Update profile image
     *
     * @param ProfileImageUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateImage(ProfileImageUpdateRequest $request)
    {
        $response = ImageUpload::uploadBase64('profile_image', FileDestinations::PROFILE_IMAGES );
        if ($response['status']) {
            $admin = Auth::user();
            $admin->update([
                'profile_image' => $response['data']['fileName']
            ]);
            Toastr::success('Profile image updated successfully');
        } else {
            Toastr::error('Image upload error');
        }
        return redirect()->route($this->getRoute('index'));
    }

}
