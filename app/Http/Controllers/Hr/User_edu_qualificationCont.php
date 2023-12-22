<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Cat\Room\Meal_cat;
use App\Models\Hr\User_edu_qualification;
use Illuminate\Http\Request;

class User_edu_qualificationCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = User_edu_qualification::all();

        return view('hr/edu_qualification.index', compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hr/edu_qualification.create');
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
            'name' => 'required',
        ]);

        $resource = User_edu_qualification::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('sett.user_edu_qualification.index')
            ->with('success', 'Qualification has been created successfully');
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
        $resource = User_edu_qualification::find($id);
        return view('hr/edu_qualification.edit', compact('resource'));
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

        $treatment = User_edu_qualification::find($id);
        $treatment->name = $request->input('name');
        $treatment->save();

        return redirect()->route('sett.user_edu_qualification.index')
            ->with('success', 'Qualification has updated successfully');
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
            'item_id' => ['required', 'exists:user_edu_qualifications,id'],
        ]);

        $id = $request->input('item_id');

        $item = User_edu_qualification::find($id);
        $item->delete();

        session()->flash('success', 'The item has been deleted successfully');
        return redirect()->route('sett.user_edu_qualification.index');
    }
}
