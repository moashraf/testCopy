<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoadMapScool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $last_roadmap_access = Auth::guard('school')->user()->roadmap;
        $shared_school = Auth::guard('school')->user()->shared_school;

        /*
        1- choose school2- welcome, 3-general info sc1, 4- facilities sc1, 5- students sc1, 6- entsab sc1, 7- teachers sc1, 8- administrators sc1, 9- other info sc1, 10- general info sc2, 11- facilities sc2, 12- students sc2, 12- entsab sc2, 13- teachers sc2, 13- administrators sc2, 14- other info sc2
        */

        if ($shared_school == 1 && $last_roadmap_access <= 10) {
            return redirect()->route('school_route.roadmap');
        } elseif ($shared_school == 2 && $last_roadmap_access <= 19) {
            return redirect()->route('school_route.second_roadmap');
        } else {
            return $next($request);
        }
        // return $next($request);
    }
}
