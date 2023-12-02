<?php

namespace App\Http\Controllers;

use App\Models\Basic\Video_tutorial;
use App\Models\Branch\Slider;
use App\Models\School\Meetings\Committees_and_teams;
use App\Models\School\School;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $current_school = Auth::guard('school')->user()->current_working_school_id;

        $school = School::find($current_school);


        $sliders = Slider::where('type', 1)->get();

        // video tutorial
        $video_tutorial = Video_tutorial::where('type', 2)->first();

        return view('website.school.new_meeting',
            compact('current_school', 'school', 'sliders', 'video_tutorial'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        //
    }
}
