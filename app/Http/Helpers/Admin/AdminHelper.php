<?php

namespace App\Http\Helpers\Admin;

use App\Http\Constants\UserConstants;


class AdminHelper
{
    public static function getAdminStatus($status = UserConstants::STATUS_ACTIVE)
    {
        $format = '<span class="badge rounded-pill %s">%s</span>';
        $message = '';
        switch ($status) {
            case UserConstants::STATUS_ACTIVE:
                $message = sprintf($format, 'badge-light-success',UserConstants::STATUS[UserConstants::STATUS_ACTIVE]);
                break;

            case UserConstants::STATUS_INACTIVE:
                $message = sprintf($format, 'badge-light-danger',UserConstants::STATUS[UserConstants::STATUS_INACTIVE]);
                break;

            // case UserConstants::STATUS_ARCHIVED:
            //     $message = sprintf($format, 'badge-light-warning',UserConstants::STATUS[UserConstants::STATUS_ARCHIVED]);
            //     break;

            default:
                break;
        }
        return $message;
    }
}
