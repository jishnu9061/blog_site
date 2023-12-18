<?php

namespace App\Services\User;

use App\Models\UserLoginLog;

class HomePageService
{
    /**
     * Get latest user login logs
     *
     * @param int $limit
     * @return mixed
     */
    public function getRecentLogins($limit = 8)
    {
        return UserLoginLog::orderBy('id', 'desc')->limit($limit)->get();
    }


}
