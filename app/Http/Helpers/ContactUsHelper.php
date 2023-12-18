<?php


namespace App\Http\Helpers;

use App\Models\ContactUs;

use Illuminate\Support\Facades\DB;

class ContactUsHelper
{

     /**
     * get  total message count
     *
     */
    public static function getTotalMessageCount()
    {

        return DB::table(ContactUs::getTableName())
            ->count();

    }
}
