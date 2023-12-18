<?php


namespace App\Http\Helpers;

use App\Http\Constants\FileDestinations;

use App\Models\Testimonial;
use App\Models\Page;

use App\Http\Helpers\Core\FileManager;

use Illuminate\Support\Facades\DB;

class PageHelper
{
    public static function getTestimonialUserImage($imageName)
    {
        $file = asset('images/default-user.png');
        if (null != $imageName) {

            if (FileManager::checkFileExist($imageName, FileDestinations::TESTIMONIALS_IMAGE)) {
                $file = FileManager::getFileUrl($imageName, FileDestinations::TESTIMONIALS_IMAGE);

            }

        }

        return $file;
    }
    /**
     * get  total testimonilas count
     *
     */
    public static function getTotalTestimonialCount()
    {

        return DB::table(Testimonial::getTableName())
            ->count();

    }
     /**
     * get  total page count
     *
     */
    public static function getTotalPageCount()
    {

        return DB::table(Page::getTableName())
            ->count();

    }
    /**
     * get  active page count
     *
     */
    public static function getActivePageCount()
    {

        return DB::table(Page::getTableName())
            ->where('status',1)
            ->count();

    }
}
