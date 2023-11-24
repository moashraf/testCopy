<?php

namespace App\Http\Controllers\Branch\Cats;

use App\Http\Controllers\Controller;
use App\Models\Branch\Branch;
use App\Models\Invoice\Coupon;
use Illuminate\Http\Request;

class Coupon_cat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::all();
        return view('cats/couponcat.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats/couponcat.create');
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
            'code' => 'required|unique:coupons,code',
            'type' => 'required',
        ]);

        $coupon = Coupon::create([
            'code' => $request->input('code'),
            'type' => $request->input('type'),
            'value' => $request->input('value'),
            'percent_off' => $request->input('percent'),
        ]);

        return redirect()->route('sett.couponcat.index')
            ->with('success', 'Coupon has created successfully');
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
        $coupon = Coupon::find($id);
        return view('cats/couponcat.edit', compact('coupon'));
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
            'type' => 'required',
        ]);

        if ($request->input('type') === "fixed") {
            $value = $request->input('value');
            $percent = null;
        } else {
            $percent = $request->input('percent');
            $value = null;
        }

        $coupon = Coupon::find($id);
        $coupon->type = $request->input('type');
        $coupon->value = $value;
        $coupon->percent_off = $percent;
        $coupon->status = $request->input('status');
        $coupon->save();

        return redirect()->route('sett.couponcat.index')
            ->with('success', 'Coupon has updated successfully');
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
            'item_id' => ['required', 'exists:coupons,id'],
        ]);

        $id = $request->input('item_id');

        $item = Coupon::find($id);
        $item->delete();

        session()->flash('success', 'The coupon has been deleted successfully');
        return redirect()->route('sett.couponcat.index');
    }
}
