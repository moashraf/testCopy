<?php

namespace App\Http\Controllers;

use App\Models\Basic\Video_tutorial;
use App\Models\Branch\Slider;
use App\Models\School\Meetings\meeting_agenda;
use App\Models\School\Meetings\meeting_recommendations;
use App\Models\School\Meetings\meetings;
use App\Models\School\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Mpdf\Mpdf;

class meeting extends Controller
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
            'committees_and_teams_id' => 'required',
            'title' => 'required',
        ]);

        $form = meetings::create([
            'committees_and_teams_id'=>$request->input('committees_and_teams_id'),
            'Number_of_attendees' => $request->input('number_of_attendees'),
            'title' => $request->input('title'),
            'Target_group' => $request->input('Target_group'),
            'status' => $request->input('status'),
            'location' => $request->input('location'),
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'type' => $request->input('type'),
            'end_date' => $request->input('end_date'),
            'end_time' => $request->input('end_time'),
            'Semester' => $request->input('Semester'),
        ]);

        return redirect()->back()->with('success', 'Your form has been sent successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $current_school = Auth::guard('school')->user()->current_working_school_id;

        $school = School::find($current_school);


        $sliders = Slider::where('type', 1)->get();
        $item_val = meetings::find($id);

        // video tutorial
        $video_tutorial = Video_tutorial::where('type', 2)->first();

        return view('website.school.new_meeting',
            compact('current_school', 'school','item_val', 'sliders', 'video_tutorial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'committees_and_teams_id' => 'required',
        ]);
        $this->updatebyid($id, $request);
        return redirect()->back()->with('success', 'Your form has been sent successfully');
    }    /**
     * updateAllData the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function updateAllData(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'committees_and_teams_id' => 'required',
            'meeting_id' => 'required',
            'Item' => 'required',
        ]);
        $this->updatebyid($id, $request);
        $meeting_recommendations = meeting_recommendations::create([
            'meeting_id'=>$request->input('meeting_id'),
            'Item'=>$request->input('Item'),
            'status'=>$request->input('status'),
            'reason'=>$request->input('reason'),
        ]);
        $meeting_agenda = meeting_agenda::create([
            'meeting_id'=>$request->input('meeting_id'),
            'Item'=>$request->input('Item'),
        ]);
        return redirect()->back()->with('success', 'Your meeting details has been saved successfully');
    }


    public function downloadPDF($id)
    {
        $meeting = meetings::findOrFail($id);

        $pdf = new Mpdf();
        $current_school = Auth::guard('school')->user()->current_working_school_id;

        $school = School::find($current_school);


        $sliders = Slider::where('type', 1)->get();
        $item_val = meetings::find($id);

        // video tutorial
        $video_tutorial = Video_tutorial::where('type', 2)->first();
        // Load a view for the PDF content and convert it to HTML
        $html =view('website.school.new_meeting',
            compact('current_school', 'school', 'sliders', 'video_tutorial'))->render();

        $pdf->WriteHTML($html);

        // Output the PDF as download
        return $pdf->Output('meeting_'.$id.'.pdf', 'D');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $meetings = meetings::find($id);

        if ($meetings) {
            $meetings->delete();
            return redirect()->back()->with('success', 'Record has been deleted successfully');
        }

        return redirect()->back()->with('error', 'Record not found');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return void
     */
    public function updatebyid(int $id, Request $request): void
    {
        $meetings = meetings::find($id);
        $meetings->committees_and_teams_id = $request->input('committees_and_teams_id');
        $meetings->number_of_attendees = $request->input('number_of_attendees');
        $meetings->Target_group = $request->input('Target_group');
        $meetings->title = $request->input('title');
        $meetings->status = $request->input('status');
        $meetings->location = $request->input('location');
        $meetings->start_date = $request->input('start_date');
        $meetings->start_time = $request->input('start_time');
        $meetings->type = $request->input('type');
        $meetings->end_date = $request->input('end_date');
        $meetings->end_time = $request->input('end_time');
        $meetings->save();
    }
}
