<?php

namespace App\Http\Controllers;

use App\Models\Basic\Video_tutorial;
use App\Models\Branch\Slider;
use App\Models\School\Meetings\Committees_and_teams;
use App\Models\School\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitteesAndTeamsMeetingsController extends Controller
{
    use HasFactory, SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $current_school = Auth::guard('school')->user()->current_working_school_id;
        $school = School::find($current_school);
        $Committees_and_teams = Committees_and_teams::where('school_id',$school->id)->get();
        Carbon::setLocale('ar');
        //Carbon::now()->translatedFormat('l j F Y H:i:s');
        $today_date_ar = Carbon::now()->translatedFormat('j F Y');
        https: //api.aladhan.com/v1/gToH/10-10-2002
        $client = new \GuzzleHttp\Client();
        $apiURL = 'http://api.aladhan.com/v1/gToH';
        $res = $client->request('GET', $apiURL, [
            'json' => [
                "date" => Carbon::now(),
            ],
        ]);

        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody(), true);
        $hijri_day = $responseBody['data']['hijri']['day'];
        $hijri_month = $responseBody['data']['hijri']['month']['ar'];
        $hijri_year = $responseBody['data']['hijri']['year'];
        $hijri_date = $hijri_day . " " . $hijri_month . " " . $hijri_year;

        $video_tutorial = Video_tutorial::where('type', 2)->first();



        return view('website.school.Committees_and_teams_meetings',
            compact('current_school', 'school', 'today_date_ar', 'hijri_date','Committees_and_teams','video_tutorial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'school_id' => 'required',
        ]);

        $form = Committees_and_teams::create([
            'meeting_id'=>$request->input('meeting_id'),
            'Item'=>$request->input('Item'),
        ]);

        return redirect()->back()->with('success', 'Your form has been sent successfully');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_school = Auth::guard('school')->user()->current_working_school_id;

        $school = School::find($current_school);


        $sliders = Slider::where('type', 1)->get();
        $commite_and_team = Committees_and_teams::find($id);

        // video tutorial
        $video_tutorial = Video_tutorial::where('type', 2)->first();

        return view('website.school.new_meeting',
            compact('current_school', 'school','commite_and_team', 'sliders', 'video_tutorial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'school_id' => 'required',
        ]);
        $commite_and_team = Committees_and_teams::find($id);
        $commite_and_team->meeting_id = $request->input('meeting_id');
        $commite_and_team->Item = $request->input('Item');
        $commite_and_team->save();
        return redirect()->back()->with('success', 'Your form has been sent successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $committee_and_team = Committees_and_teams::find($id);

        if ($committee_and_team) {
            $committee_and_team->delete();
            return redirect()->back()->with('success', 'Record has been deleted successfully');
        }

        return redirect()->back()->with('error', 'Record not found');
    }
}
