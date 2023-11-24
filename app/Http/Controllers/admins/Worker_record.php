<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Branch\Branch;
use App\Models\Invoice\Debtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Worker_record extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debtor = Debtor::select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'), 'avatar', 'company_name')->get();
        return view('cats/debtorcat.index', compact('debtor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats/debtorcat.create');
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
            'first_name' => 'required',
            'second_name' => 'required',
            'avatar' => ['image', 'mimes:jpeg,jpg,png', 'max:200'],
        ]);

        //insert img
        if($request->hasFile('avatar')){
            $file_extension = request()->avatar->getClientOriginalExtension();
            $file_name = 'deb' . $request->input('first_name') . time() . '.' . $file_extension;
            $path = 'img/useravatar';
            $request->avatar->move($path, $file_name);
        }
        else{
            $file_name = 'default-pp.png';
        };
        
        $debtor = Debtor::create([  
            'first_name' => $request->input('first_name'),
            'second_name' => $request->input('second_name'),
            'avatar' => $file_name,
            'company_name' => $request->input('company_name'),
        ]);

        return redirect()->route('sett.debtorcat.index')
            ->with('success', 'Debtor has created successfully');
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
        $debtor = Debtor::find($id);
        return view('cats/debtorcat.edit', compact('debtor'));
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
            'first_name' => 'required',
            'second_name' => 'required',
            'avatar' => ['image', 'mimes:jpeg,jpg,png', 'max:200'],
        ]);

        $debtor = Debtor::find($id);

        //insert img
        if($request->hasFile('avatar')){

            if($debtor->avatar !== "default-pp.png"){
                //to remove the old avatar and also keep the default img
                $imagePath = public_path('img/useravatar/'.$debtor->avatar);
                if(File::exists($imagePath)){
                    File::delete($imagePath);
                }
            }
            
            $file_extension = request()->avatar->getClientOriginalExtension();
            $file_name = 'deb' . $request->input('first_name') . time() . '.' . $file_extension;
            $path = 'img/useravatar';
            $request->avatar->move($path, $file_name);

            $debtor->avatar = $file_name; //new img file name
        }
        else{
            $file_name = request()->avatar;
        }

        $debtor->first_name = $request->input('first_name');
        $debtor->second_name = $request->input('second_name');
        $debtor->company_name = $request->input('company_name');
        $debtor->save();

        return redirect()->route('sett.debtorcat.index')
            ->with('success', 'Debtor has updated successfully');
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