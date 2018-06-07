<?php

namespace App\Http\Controllers;

use App\Unit_price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function showPrices(Request $request) {
        //fetch range of unit prices for API
        $result = [];
        $from_date = ($request['startDate']) ? ($request['startDate']) : (date('m/d/Y'));
        $to_date = ($request['endDate']) ? ($request['endDate']) : (date('m/d/Y'));
        
        if(!($request['startDate']) ||  !($request['endDate'])){
            $range_of_prices = DB::table('unit_prices')
            ->selectRaw("id,report_date as ReportDate,DATE_FORMAT(report_date, '%d %b %Y') AS ReportDateFormatted,rsa as RSA,retiree as Retiree")
            ->orderBy('report_date', 'desc')
            ->take(7)
            ->get();
        }else{
            $from_date = ($request['startDate']) ? ($request['startDate']) : (date('m/d/Y'));
            $to_date = ($request['endDate']) ? ($request['endDate']) : (date('m/d/Y'));
            
            $from = date('Y-m-d' . ' 00:00:00', strtotime($from_date));
            $to = date('Y-m-d' . ' 00:00:00', strtotime($to_date));
        
            $range_of_prices = DB::table('unit_prices')
            ->selectRaw("id,report_date as ReportDate,DATE_FORMAT(report_date, '%d %b %Y') AS ReportDateFormatted,rsa as RSA,retiree as Retiree")
            ->whereBetween('report_date', [$from, $to])
            ->orderBy('report_date', 'desc')
            ->get();
        }
        
        if ($range_of_prices) {
            $result = $range_of_prices;
        }
        return json_encode($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit_price  $unit_price
     * @return \Illuminate\Http\Response
     */
    public function show(Unit_price $unit_price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit_price  $unit_price
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit_price $unit_price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit_price  $unit_price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit_price $unit_price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit_price  $unit_price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit_price $unit_price)
    {
        //
    }
}
