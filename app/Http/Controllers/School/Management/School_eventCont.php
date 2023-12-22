<?php

namespace App\Http\Controllers\School\Management;

use App\Http\Controllers\Controller;
use App\Models\Patient\Ask_for_main_cat as PatientAsk_for_main_cat;
use App\Models\School\Management\Edu_department;
use App\Models\School\Student\School_event;
use App\Models\School\Teacher\School_job;
use App\Models\School\Teacher\Teacher_speciality;
use Illuminate\Http\Request;

class School_eventCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $askfor = School_event::get();
        return view('school/management/school_event.index', compact('askfor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school/management/school_event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:school_events,name',
            'event_date' => 'required|date',
        ]);

        $examination = School_event::create([
            'name' => $request->input('name'),
            'event_date' => $request->input('event_date'),
        ]);

        return redirect()->route('sett.school_event.index')
            ->with('success', 'The item has been created successfully');
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
        $askfor = School_event::find($id);
        return view('school/management/school_event.edit', compact('askfor'));
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        $askfor = School_event::find($id);
        $askfor->name = $request->input('name');
        $askfor->event_date = $request->input('event_date');
        $askfor->save();

        return redirect()->route('sett.school_event.index')
            ->with('success', 'Item has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->validate($request, [
            'item_id' => ['required', 'exists:school_events,id'],
        ]);

        $id = $request->input('item_id');

        $item = School_event::find($id);
        $item->delete();

        session()->flash('success', 'The item has been deleted successfully');
        return redirect()->route('sett.school_event.index');
    }
}
