<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\City_dest;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = City_dest::all();
        return view('admin.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
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
            $request,[
                'img' => 'image|mimes:jpeg,jpg,png|max:700|dimensions:max_width:300,max_height:200',
                'cover_image' => 'image|mimes:jpeg,jpg,png|max:700|dimensions:max_width:300,max_height:200',
                'name' => 'required|max:30|min:10',
                'slug' => 'required|max:30|min:10',
                // 'short_description' => 'required|max:50|min:10',
                'description' => 'required',
             ]);


        if ($request->hasFile('img')) {
            $file_extension = request()->img->getClientOriginalExtension();
            $file_name = $request->input('title') . time() . '.' . $file_extension;
            $path = 'img/articles';
            $request->img->move($path, $file_name);
        }
        $articles = City_dest::create([
            'title' =>  $request->input('title'),
            'tag_id' =>  $request->input('tag_id'),
            'description' =>  $request->input('description'),
            'default' =>  $request->input('default',0),
            'img' =>  $file_name,
            'slug' =>  $request->input('slug'),
            'short_description' =>  $request->input('short_description'),
        ]);

        session()->flash('success', 'The article has been created');
        return redirect()->route('sett.articles.index');
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
        //
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
        //
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
