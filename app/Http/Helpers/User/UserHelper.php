<?php


namespace App\Http\Helpers\User;

use App\Models\User;

use Illuminate\Support\Facades\DB;

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
}
