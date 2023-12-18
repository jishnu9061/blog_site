<?php
/*
 * Breadcrumbs Helper
 *
 * @author Agin
 * @date 26-Oct-2018
 */

namespace App\Services\Admin;

use App\Http\Constants\SupportTicketConstants;

use App\Http\Helpers\Core\DateHelper;

use App\Models\AdminLoginLog;
use App\Models\SupportTicket;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class HomePageService
{

    public function getRegistrationGraphData()
    {
        $registrations = DB::table(User::getTableName())
            ->select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', DateHelper::getCurrentYear())
            ->groupBy('month','created_at')
            ->orderBy('created_at','asc')
            ->get();
        $keyed = $registrations->mapWithKeys(function ($item) {
            return [$item->month => $item->total];
        });
        $formattedOrders = $keyed->all();
        $graphData = [];
        foreach ($formattedOrders as $month => $registrationCount) {
            $graphData['item'][] = $month;
            $graphData['data'][] = $registrationCount;
        }
        if( empty($graphData)) {
            $graphData['item'][] = Carbon::now()->format('F');
            $graphData['data'][] = 0;
        }
        return $graphData;
    }

    public function getRegistrationGrowthRate()
    {
        $currentYearRegistrationCount = User::whereYear('created_at', DateHelper::getCurrentYear())->count();
        $totalUsers = User::count();
        return ($currentYearRegistrationCount * 100) / $totalUsers;
    }

    public function getRegisteredUsersList($limit = 8)
    {
        return User::orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * @param string $status // UserConstants::STATUS_INACTIVE, UserConstants::STATUS_ACTIVE
     * @return mixed
     */
    public function getUsersCount($status = '')
    {
        return ('' == $status) ? User::count() : User::where('status', $status)->count();
    }

    public function getSupportTicketCount()
    {
        return SupportTicket::count();
    }

    public function getRecentLogins($limit = 8)
    {
        return AdminLoginLog::orderBy('id', 'desc')->limit($limit)->get();
    }

    public function getLatestSupportTickets($limit = 8)
    {
        return DB::table(SupportTicket::getTableName().' as s')
            ->select(['s.id', 's.subject', 'u.first_name', 'u.profile_image', 's.status', 's.created_at'])
            ->join(User::getTableName().' as u', 'u.id', 's.user_id')
            ->where('s.status', SupportTicketConstants::STATUS_OPENED)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }

}

