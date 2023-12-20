<?php


namespace App\Http\Helpers\User;

use App\Models\User;

use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Core\FileManager;
use App\Http\Constants\FileDestinations;

class UserHelper
{
  /**
     * get  total user count
     *
     */
    public static function getTotalUserCount()
    {

        return DB::table(user::getTableName())
            ->count();

    }
    /**
     * get  active user count
     *
     */
    public static function getActiveUserCount()
    {

        return DB::table(user::getTableName())
            ->where('status',1)
            ->count();

    }

    public static function getArticleImage($imageName)
    {
        $file = asset('images/default-image.png');
        // dd($imageName);
        if (null != $imageName) {
            if (FileManager::checkFileExist($imageName, FileDestinations::ARTICLE_IMAGE)) {
                $file = FileManager::getFileUrl($imageName, FileDestinations::ARTICLE_IMAGE);
            }
        }
        return $file;
    }
}
