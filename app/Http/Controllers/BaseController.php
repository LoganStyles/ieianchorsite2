<?php

namespace App\Http\Controllers;

use App\Unit_price;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BaseController extends Controller {

    public function __construct() {
        
    }

    /* test if user is logged in & check access */

    protected function isLoggedIn() {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    protected function getPageData($item) {
        $itemimages = $item . 'images';
        $items = $item . 's';
        $arrays = [];

        
        $moduleitems = DB::table($items)
                ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                ->where('display', '1')
                ->orderBy('position', 'asc')
                ->take(15)
                ->get();

        foreach ($moduleitems as $object) {
            $arrays[] = (array) $object;
        }
        return $arrays;
    }

    protected function getPageDataNoImages($item) {
        $items = $item . 's';
        $moduleitems = DB::table($items)->select('*')->distinct()->get();
        foreach ($moduleitems as $object) {
            $arrays[] = (array) $object;
        }
        return $arrays;
    }

    protected function getHomePageData() {
        $servicesitems = DB::table('services')
                ->leftjoin('serviceimages', 'services.id', '=', 'serviceimages.itemid')
                ->select('services.*', 'serviceimages.filename', 'serviceimages.itemid as imageid', 'serviceimages.alt', 'serviceimages.caption', 'serviceimages.main')
                ->where('display', '1');

        $testimonialsitems = DB::table('testimonials')
                ->leftjoin('testimonialimages', 'testimonials.id', '=', 'testimonialimages.itemid')
                ->select('testimonials.*', 'testimonialimages.filename', 'testimonialimages.itemid as imageid', 'testimonialimages.alt', 'testimonialimages.caption', 'testimonialimages.main')
                ->where('display', '1');

        $bannersitems = DB::table('banners')
                ->leftjoin('bannerimages', 'banners.id', '=', 'bannerimages.itemid')
                ->select('banners.*', 'bannerimages.filename', 'bannerimages.itemid as imageid', 'bannerimages.alt', 'bannerimages.caption', 'bannerimages.main')
                ->where('display', '1')
                ->take(4);

        $awards = DB::table('awards')
                ->leftjoin('awardimages', 'awards.id', '=', 'awardimages.itemid')
                ->select('awards.*', 'awardimages.filename', 'awardimages.itemid as imageid', 'awardimages.alt', 'awardimages.caption', 'awardimages.main')
                ->where('display', '1');

        $items = $servicesitems->union($testimonialsitems)->union($bannersitems)->union($awards);
        $data = $items->get();

        foreach ($data as $object) {
            $arrays[] = (array) $object;
        }
        return $arrays;
    }

    protected function getDBData($item, $subitem = NULL, $ref = NULL) {
        $itemimages = $item . 'images';
        $items = $item . 's';
        $arrays = [];

        //get the latest 10 items

        if ($item == "site") {
            //site info needed for header
            $moduleitems = DB::table('sites')
                    ->leftjoin('siteimages', 'sites.id', '=', 'siteimages.itemid')
                    ->select('sites.*', 'siteimages.filename', 'siteimages.itemid as imageid', 'siteimages.alt', 'siteimages.caption', 'siteimages.main')
                    ->get();
        } else if ($item == "faq") {
            $moduleitems = DB::table($items)
                    ->select('faqs.category_id', 'faqs.question', 'faqs.answer', 'faqs.created_at', 'faqs.updated_at')
                    ->leftjoin('faqcats', 'faqcats.id', '=', 'faqs.category_id')
                    ->where('faqcats.title', $subitem)
                    ->get();
        } else if ($item == "download") {
            $moduleitems = DB::table($items)
                    ->select('downloads.category_id', 'downloads.title', 'downloads.filename', 'downloads.display')
                    ->leftjoin('downloadcats', 'downloadcats.id', '=', 'downloads.category_id')
                    ->where('downloadcats.title', $subitem)
                    ->get();
        } else if ($ref) {
            $moduleitems = DB::table($items)->get();
        } else if ($subitem) {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->where([[$items . '.link_label', $subitem], ['display', '1']])
                    ->get();
        } else if ($item == "newsitem" || $item == "article") {

            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->where('display', '1')
                    ->orderBy('id', 'desc')
                    ->take(10)
                    ->get();
        } else {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->where('display', '1')
                    ->orderBy('position', 'asc')
                    ->take(15)
                    ->get();
        }

        foreach ($moduleitems as $object) {
            $arrays[] = (array) $object;
        }
        return $arrays;
    }

    protected function getDBPaginatedData($item, $subitem = NULL, $ref = NULL) {
        $itemimages = $item . 'images';
        $items = $item . 's';
        $arrays = [];

        //get the latest 10 items

        if ($item == "site") {
            //site info needed for header
            $moduleitems = DB::table('sites')
                    ->leftjoin('siteimages', 'sites.id', '=', 'siteimages.itemid')
                    ->select('sites.*', 'siteimages.filename', 'siteimages.itemid as imageid', 'siteimages.alt', 'siteimages.caption', 'siteimages.main')
                    ->paginate(5);
        } else if ($item == "faq" && $subitem) {
            $moduleitems = DB::table($items)
                    ->select('*')
                    ->where('category_id', $subitem)
                    ->paginate(5);
        } else if ($ref) {
            $moduleitems = DB::table($items)->paginate(5);
        } else if ($item == "faqcat") {
            $moduleitems = DB::table($items)->paginate(5);
        } else if ($item == "faq") {
            $moduleitems = DB::table('faqs')
                    ->leftjoin('faqcats', 'faqs.category_id', '=', 'faqcats.id')
                    ->select('faqcats.title', 'faqcats.id as cat_id', 'faqs.question', 'faqs.*')
                    ->paginate(5);
        } else if ($subitem) {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->where($items . '.link_label', $subitem)
                    ->paginate(5);
        } else if ($item == "newsitem" || $item == "article") {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        } else {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->orderBy('position', 'asc')
                    ->paginate(5);
        }

        return $moduleitems;
    }

    protected function showPaginatedList($item) {
        $itemimages = $item . 'images';
        $items = $item . 's';
        if ($item == "faq") {
            $items = "faqcats";
        }

        if ($item == "download") {
            $items = "downloadcats";
        }
        $paginateditems = DB::table($items)->where('display', '1')->paginate(15);
        return $paginateditems;
    }

}
