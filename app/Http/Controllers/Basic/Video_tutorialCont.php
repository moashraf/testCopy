<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Models\Basic\Video_tutorial;
use App\Models\Branch\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Video_tutorialCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Video_tutorial::get();

        return view('basic/video_tutorial.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats/slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'type' => 'required',
                'url' => 'required|min:3',
            ]
        );

        $unit = Slider::create([
            'url' => $request->input('name'),
        ]);

        return redirect()->route('sett.slider.index')
            ->with('success', 'Slider has created successfully');
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
        $slider = Video_tutorial::find($id);

        return view('basic/video_tutorial.edit', compact('slider'));
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
        $this->validate(
            $request,
            [
                'url' => 'required|min:3',
            ]
        );

        $slider = Video_tutorial::find($id);
        $slider->url = $request->input('url');
        $slider->save();

        return redirect()->route('sett.video_tutorial.index')
            ->with('success', 'Slider has updated successfully');
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
