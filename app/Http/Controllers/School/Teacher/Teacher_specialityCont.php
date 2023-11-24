<?php

namespace App\Http\Controllers\School\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Patient\Ask_for_main_cat as PatientAsk_for_main_cat;
use App\Models\School\Management\Edu_department;
use App\Models\School\Teacher\Teacher_speciality;
use Illuminate\Http\Request;

class Teacher_specialityCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $askfor = Teacher_speciality::get();
        return view('school/management/teacher_speciality.index', compact('askfor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school/management/teacher_speciality.create');
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
            'name' => 'required|unique:teacher_specialities,name',
        ]);

        $examination = Teacher_speciality::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('sett.teacher_speciality.index')
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
        $askfor = Teacher_speciality::find($id);
        return view('school/management/teacher_speciality.edit', compact('askfor'));
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

        $askfor = Teacher_speciality::find($id);
        $askfor->name = $request->input('name');
        $askfor->save();

        return redirect()->route('sett.teacher_speciality.index')
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
            'item_id' => ['required', 'exists:teacher_specialities,id'],
        ]);

        $id = $request->input('item_id');

        $item = Teacher_speciality::find($id);
        $item->delete();

        session()->flash('success', 'The item has been deleted successfully');
        return redirect()->route('sett.teacher_speciality.index');
    }
}
