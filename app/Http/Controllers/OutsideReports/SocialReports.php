<?php

namespace App\Http\Controllers\OutsideReports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;


class SocialReports extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function google()
    {
        $most_visited = Analytics::fetchMostVisitedPages(Period::days(30), 10);
        
        $top_browsers = Analytics::fetchTopBrowsers(Period::days(30));
        
        $top_countries = Analytics::performQuery(Period::days(30), 'ga:country',['dimensions'=>'ga:country', 'metrics'=>'ga:sessions']);

        $top_referrers = Analytics::fetchTopReferrers(Period::days(30));

        $user_type = Analytics::fetchUserTypes(Period::days(30));

        $google_aa = Analytics::getAnalyticsService();
    
        return view('outsidereports.google', compact('top_browsers', 'most_visited', 'top_referrers', 'user_type'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
    }
}