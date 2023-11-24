<?php

namespace App\Http\Controllers\Branch\Cats;

use App\Http\Controllers\Controller;
use App\Models\Branch\Airport as PatientAirport;
use App\Models\Branch\Currency;
use App\Models\location\Country;
use App\Models\Patient\From_recourse;
use Illuminate\Http\Request;

class CurrencyCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airports = Currency::all();
        return view('cats/currency.index', compact('airports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Currency::all();
        return view('cats/currency.create', compact('countries'));
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
            'name' => 'required|unique:currencies,name',
            'code' => 'required|unique:currencies,name',
            'rate' => 'required',
        ]);

        $resource = Currency::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'rate' => $request->input('rate'),
        ]);

        return redirect()->route('sett.currency.index')
            ->with('success', 'Currency has been created successfully');
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
        $airport = Currency::find($id);

        return view('cats/currency.edit', compact('airport'));
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
            'code' => 'required',
            'rate' => 'required',
        ]);

        $treatment = Currency::find($id);
        $treatment->name = $request->input('name');
        $treatment->code = $request->input('code');
        $treatment->rate = $request->input('rate');
        $treatment->save();

        return redirect()->route('sett.currency.index')
            ->with('success', 'Currency has updated successfully');
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