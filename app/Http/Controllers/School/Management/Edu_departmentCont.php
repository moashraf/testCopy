<?php

namespace App\Http\Controllers\School\Management;

use App\Http\Controllers\Controller;
use App\Models\Patient\Ask_for_main_cat as PatientAsk_for_main_cat;
use App\Models\School\Management\Edu_department;
use Illuminate\Http\Request;

class Edu_departmentCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $askfor = Edu_department::get();
        return view('school/management/edu_department.index', compact('askfor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school/management/edu_department.create');
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
            'name' => 'required|unique:edu_departments,name',
        ]);

        $examination = Edu_department::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('sett.edu_department.index')
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
        $askfor = Edu_department::find($id);
        return view('school/management/edu_department.edit', compact('askfor'));
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

        $askfor = Edu_department::find($id);
        $askfor->name = $request->input('name');
        $askfor->save();

        return redirect()->route('sett.edu_department.index')
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
            'item_id' => ['required', 'exists:edu_departments,id'],
        ]);

        $id = $request->input('item_id');

        $item = Edu_department::find($id);
        $item->delete();

        session()->flash('success', 'The item has been deleted successfully');
        return redirect()->route('sett.edu_department.index');
    }
}
