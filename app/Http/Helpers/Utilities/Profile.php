<?php


namespace App\Http\Helpers\Utilities;

use App\Http\Constants\AuthConstants;
use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\DateHelper;
use App\Http\Helpers\Core\FileManager;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


class Profile
{

    /**
     * Get profile image based on logged user
     * @param string $guard
     * @param string $destination
     * @return string
     */
    public static function getProfileImage($guard = 'web', $destination = FileDestinations::PROFILE_IMAGES)
    {
        $file = asset('images/default-user.png');
        $authUser = Auth::guard($guard)->user();
        if (null != $authUser->profile_image) {
            if (FileManager::checkFileExist($authUser->profile_image, $destination)) {
                $file = FileManager::getFileUrl($authUser->profile_image, $destination);
            }
        }
        return $file;
    }

    /**
     * Get user created date based on logged user
     * @param string $guard
     * @return string
     */
    public static function getMemberSince($guard = 'web')
    {
        $admin = Auth::guard($guard)->user();
        return DateHelper::getCurrentHumanReadableTimeFromDate($admin->created_at);
    }

    /**
     * Get user full name based on logged user
     * @param string $guard
     * @return string
     */
    public static function getFullName($guard = 'web')
    {
        $admin = Auth::guard($guard)->user();
        return ucfirst($admin->first_name).' '.ucfirst($admin->last_name);
    }

    /**
     * Get mobile number
     * @param string $guard
     * @return mixed
     */
    public static function getMobileNumber($guard = 'web')
    {
        $admin = Auth::guard($guard)->user();
        return $admin->mobile;
    }

    /**
     * Format user name
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public static function getFullNameFormatted($firstName = '', $lastName = '')
    {
        return ucfirst($firstName).' '.ucfirst($lastName);
    }

//    public static function getProfileImageFromFile($filename, $destination = FileDestinations::PROFILE_IMAGES)
//    {
//        $file = asset('images/default-user.png');
//        if (null != $filename) {
//            if (FileManager::checkFileExist($filename, $destination)) {
//                $file = FileManager::getFileUrl($filename, $destination);
//            }
//        }
//        return $file;
//    }

    public static function getProfileImageFromFile($filename = null, $guard = 'web')
    {
        $file = asset('images/default-user.png');
        if (null != $filename) {
            switch ($guard) {

                case AuthConstants::GUARD_ADMIN:
                    if (FileManager::checkFileExist($filename, FileDestinations::PROFILE_ADMIN)) {
                        $file = FileManager::getFileUrl($filename, FileDestinations::PROFILE_ADMIN);
                    }
                    break;

                case AuthConstants::GUARD_USER:
                    if (FileManager::checkFileExist($filename, FileDestinations::PROFILE_USER)) {
                        $file = FileManager::getFileUrl($filename, FileDestinations::PROFILE_USER);
                    }
                    break;

                default:
                    $file = asset('images/default-user.png');
                    break;

            }

        }
        return $file;
    }

}
