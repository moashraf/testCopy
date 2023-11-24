<?php

namespace App\Http\Controllers\Patient\Cats;

use App\Http\Controllers\Controller;
use App\Models\Patient\From_recourse;
use Illuminate\Http\Request;

class Resource_cat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = From_recourse::all();
        return view('cats/fromresourcecat.index', compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats/fromresourcecat.create');
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
            'name' => 'required|unique:treatment_cats,name',
        ]);

        $resource = From_recourse::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('sett.resourcecat.index')
            ->with('success', 'Treatment has been created successfully');
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
        $resource = From_recourse::find($id);
        return view('cats/fromresourcecat.edit', compact('resource'));
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

        $treatment = From_recourse::find($id);
        $treatment->name = $request->input('name');
        $treatment->save();

        return redirect()->route('sett.resourcecat.index')
            ->with('success', 'Treatment has updated successfully');
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
            'item_id' => ['required', 'exists:from_recourses,id'],
        ]);

        $id = $request->input('item_id');

        $item = From_recourse::find($id);
        $item->delete();

        session()->flash('success', 'The item has been deleted successfully');
        return redirect()->route('sett.resourcecat.index');
    }
}