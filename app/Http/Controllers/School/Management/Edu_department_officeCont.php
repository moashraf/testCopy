<?php

namespace App\Http\Controllers\School\Management;

use App\Http\Controllers\Controller;
use App\Models\Patient\Ask_for_cat as PatientAsk_for_cat;
use App\Models\Patient\Ask_for_main_cat;
use App\Models\School\Management\Edu_department;
use App\Models\School\Management\Edu_department_office;
use Illuminate\Http\Request;

class Edu_department_officeCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $askfor = Edu_department_office::with(['department' => function ($q) {
            $q->select('id', 'name');
        }])
            ->get();

        return view('school/management/edu_department_office.index', compact('askfor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_cat = Edu_department::all();
        return view('school/management/edu_department_office.create', compact('main_cat'));
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
            'ask_for_main_cat_id' => 'required|exists:edu_departments,id',
            'name' => 'required|unique:ask_for_cats,name',
        ]);

        $examination = Edu_department_office::create([
            'edu_department_id' => $request->input('ask_for_main_cat_id'),
            'name' => $request->input('name'),
        ]);

        return redirect()->route('sett.edu_department_office.index')
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

        $askfor = Edu_department_office::find($id);
        $main_cat = Edu_department::all();

        return view('school/management/edu_department_office.edit', compact('askfor', 'main_cat'));
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
            'ask_for_main_cat_id' => 'required|exists:edu_departments,id',
            'name' => 'required',
        ]);

        $askfor = Edu_department_office::find($id);
        $askfor->edu_department_id = $request->input('ask_for_main_cat_id');
        $askfor->name = $request->input('name');
        $askfor->save();

        return redirect()->route('sett.edu_department_office.index')
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
            'item_id' => ['required', 'exists:edu_department_offices,id'],
        ]);

        $id = $request->input('item_id');

        $item = Edu_department_office::find($id);
        $item->delete();

        session()->flash('success', 'The item has been deleted successfully');
        return redirect()->route('sett.edu_department_office.index');
    }
}
