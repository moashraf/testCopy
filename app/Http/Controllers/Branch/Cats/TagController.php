<?php

namespace App\Http\Controllers\Branch\Cats;

use App\Http\Controllers\Controller;
use App\Models\Branch\Branch;
use App\Models\Branch\Image_unit;
use App\Models\Branch\Order;
use App\Models\Branch\Tag;
use App\Models\Branch\Tag_image;
use App\Models\Branch\Unit;
use App\Models\Branch\Unit_tag;
use App\Models\Invoice\Debtor;
use App\Models\location\Country;
use App\Models\location\CountryWantBook;
use App\Models\Patient\Destination;
use App\Models\Patient\Specialty_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();

        return view('cats/tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats/tags.create');
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
                'name' => 'required|max:30|min:4',
                'slug' => 'required|max:50|min:4',
            ]
        );

        $unit = Tag::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('sett.tag.index')
            ->with('success', 'Unit has created successfully');
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
        $tags = Tag::find($id);
        return view('cats/tags.edit', compact('tags'));
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
                'name' => 'required|max:30|min:4',
                'slug' => 'required|max:50|min:4',
            ]
        );

        $tags = Tag::find($id);


        $tags->name = $request->input('name');
        $tags->slug = $request->input('slug');
        $tags->save();

        return redirect()->route('sett.tag.index')
            ->with('success', 'Unit has updated successfully');
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


    public function deleteImage($id)
    {
        $img = Tag_image::find($id);
        $imagePath = public_path('img/tag' . $img->img);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $img->delete();
        session()->flash('success', 'The image has been deleted ');
        return back();
    }
}
