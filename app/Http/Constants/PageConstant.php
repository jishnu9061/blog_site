<?php
/**
 * page constants
 */

namespace App\Http\Constants;


class PageConstant
{
    const HOME_PAGE = 1;
    const ABOUT_US_PAGE = 2;
    const CONTACT_PAGE = 3;

    const PAGE_ROUTES = [
        self::HOME_PAGE => 'admin.home-page.index',
        self::ABOUT_US_PAGE => 'admin.about-us.index',
        self::CONTACT_PAGE => 'admin.contact.index',
    ];

    const PAGE_VIEWS = [
        self::HOME_PAGE => 'home',
        self::ABOUT_US_PAGE => 'about-us',
        self::CONTACT_PAGE => 'contact-us',
    ];
    const STATUS_ACTIVE = 0;
    const STATUS_INACTIVE = 1;


    const STATUS = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'InActive',

    ];
}

