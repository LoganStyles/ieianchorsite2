<?php

namespace App\Http\Controllers;

use App\Newsitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsitemController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $moduleitems = DB::table('newsitems')
                ->select('newsitems.*')
                ->take(10)
                ->get();
        return $moduleitems;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Newsitem  $newsitem
     * @return \Illuminate\Http\Response
     */
    public function show(Newsitem $newsitem) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Newsitem  $newsitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsitem $newsitem) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsitem  $newsitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsitem $newsitem) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsitem  $newsitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsitem $newsitem) {
        //
    }

}
