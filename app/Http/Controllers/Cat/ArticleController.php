<?php

namespace App\Http\Controllers\Cat;

use App\Http\Controllers\Controller;
use App\Models\Branch\Item_tag;
use App\Models\Branch\Tag;
use App\Models\Cat\Article\Article;
use App\Models\Cat\Article\Article_image;
use App\Models\Cat\Article\Article_tag;
use App\Models\location\Country;
use App\Models\Patient\Image_destination;
use App\Models\Patient\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destination = Article::get();
        return view('article.index', compact('destination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();
        return view('article.create', compact('tags'));
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
                'main_img' => 'required|image|mimes:jpeg,jpg,png|max:800',
                'name' => 'required|max:50|min:4|unique:articles,name',
                'slug' => 'required|max:50|min:4|unique:articles,slug',
                'short_description' => 'required|max:250|min:10',
                'description' => 'required',
                'all_imgs.*' => 'required|image|mimes:jpeg,jpg,png,webp|max:1500|dimensions:max_width:1280,max_height:900',
            ]
        );

        if ($request->hasFile('main_img')) {
            $file_extension = request()->main_img->getClientOriginalExtension();
            $file_name = "article_main_" . time() . '.' . $file_extension;
            $path = 'img/article';
            $request->main_img->move($path, $file_name);
        }


        // insert table station
        $destinations = Article::create([
            'main_img' => $file_name,
            'name' => $request->input('name'),
            'country_id' => $request->input('country_id'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),
        ]);


        // insert in table Image Station
        if ($request->hasFile('all_imgs')) {
            $images = $request->file('all_imgs');
            foreach ($images as $key => $image) {
                $file_extension = $image->getClientOriginalExtension();
                $file_name = $request->input('slug') . $key . 'article' . time() . '.' . $file_extension;
                $path = 'img/article';
                $image->move($path, $file_name);
                Article_image::create([
                    'article_id' => $destinations->id,
                    'img' => $file_name,
                ]);
            }
        }

        // insert tags
        if ($request->input('tags')) {
            foreach ($request->input('tags') as $tag) {
                $unit_tag = Article_tag::create([
                    'tag_id' => $tag,
                    'article_id' => $destinations->id,
                ]);
            }
        }

        // return $station
        session()->flash('success', 'The brand has been created');
        return redirect()->route('sett.article.index');
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
        $article = Article::find($id);

        $tags = Tag::get();
        $article_tags = $article->tags()->pluck('tag_id')->toArray();

        return view('article.edit', compact('article', 'tags', 'article_tags'));
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
        $destinations = Article::find($id);
        $destinations->name = $request->input('name');
        $destinations->slug = $request->input('slug');
        $destinations->description = $request->input('description');
        $destinations->short_description = $request->input('short_description');

        //insert img
        if ($request->hasFile('main_img')) {
            if ($destinations->main_img) {
                //to remove the old avatar and also keep the default img
                $imagePath = public_path('img/article' . $destinations->main_img);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $file_extension = request()->main_img->getClientOriginalExtension();
            $file_name = 'article_main_' . time() . '.' . $file_extension;
            $path = 'img/article';
            $request->main_img->move($path, $file_name);
            $destinations->main_img = $file_name; //new img file name
        } else {
            $file_name = request()->main_img;
        }

        $destinations->save();

        // insert in table Image Station
        if ($request->hasFile('all_imgs')) {
            $images = $request->file('all_imgs');
            foreach ($images as $key => $image) {
                $file_extension = $image->getClientOriginalExtension();
                $file_name = $request->input('slug') . $key . 'article' . time() . '.' . $file_extension;
                $path = 'img/article';
                $image->move($path, $file_name);
                Article_image::create([
                    'article_id' => $destinations->id,
                    'img' => $file_name,
                ]);
            }
        }

        // insert tags
        if ($request->input('tags')) {

            foreach ($request->input('tags') as $tag) {
                $unit_tag = Article_tag::create([
                    'tag_id' => $tag,
                    'article_id' => $id,
                ]);
            }
        }

        session()->flash('success', 'The article has been updated');
        return redirect()->route('sett.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =  $request->input('station_id');
        $destinations = Article::find($id);
        $destinations->delete();
        session()->flash('success', 'The user has been deleted');
        return redirect()->route('sett.destinations.index');
    }


    public function deleteImage($id)
    {
        $img = Article_image::find($id);
        $imagePath = public_path('img/article' . $img->destination_images);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $img->delete();
        session()->flash('success', 'The image has been deleted ');
        return back();
    }
}
