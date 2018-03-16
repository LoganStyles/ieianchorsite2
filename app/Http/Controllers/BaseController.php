<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BaseController extends Controller {

    protected $latest_prices;

    public function __construct() {
//        $this->middleware('auth');
        //get latest unit prices
        
        $this->latest_prices = DB::table('unit_prices')
                ->orderBy('report_date', 'desc')
                ->first();
        //get latest news
        $this->latest_news = DB::table('newsitems')
                ->leftjoin('newsitemimages', 'newsitems.id', '=', 'newsitemimages.itemid')
                ->select('newsitems.*', 'newsitemimages.filename', 'newsitemimages.itemid as imageid', 'newsitemimages.alt', 'newsitemimages.caption', 'newsitemimages.main')
                ->latest()
                ->first();
        View::share('latest_prices', $this->latest_prices);
        View::share('latest_news', $this->latest_news);
       
    }

    /* test if user is logged in & check access */

    protected function isLoggedIn() {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    protected function getDBData($item, $subitem = NULL,$ref=NULL) {
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
        } else if($item == "faq"){
            $moduleitems = DB::table($items)
                    ->select('*')
                    ->where('category_id',$subitem)
                    ->get();
        } else if($ref){
            $moduleitems = DB::table($items)->get();

        }else if ($subitem) {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->where($items . '.link_label', $subitem)
                    ->get();
        } else {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->orderBy('id', 'desc')
                    ->take(10)
                    ->get();

        //      print_r($moduleitems);exit;
        }

        foreach ($moduleitems as $object) {
            $arrays[] = (array) $object;
        }
        return $arrays;
    }
    
    
    protected function getDBPaginatedData($item, $subitem = NULL,$ref=NULL) {
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
        } else if($item == "faq"){
            $moduleitems = DB::table($items)
                    ->select('*')
                    ->where('category_id',$subitem)
                    ->paginate(5);
        } else if($ref){
            $moduleitems = DB::table($items)->paginate(5);;

        }else if ($subitem) {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->where($items . '.link_label', $subitem)
                    ->paginate(5);
        } else {
            $moduleitems = DB::table($items)
                    ->leftjoin($itemimages, $items . '.id', '=', $itemimages . '.itemid')
                    ->select($items . '.*', $itemimages . '.filename', $itemimages . '.itemid as imageid', $itemimages . '.alt', $itemimages . '.caption', $itemimages . '.main')
                    ->orderBy('id', 'desc')
                    ->paginate(5);

        //      print_r($moduleitems);exit;
        }

        return $moduleitems;
    }

    protected function showPaginatedList($item) {
        $itemimages = $item . 'images';
        $items = $item . 's';
        if($item=="faq"){
            $items="faqcats";
        }

        $paginateditems= DB::table($items)->paginate(5);
        return $paginateditems;
    }

}
