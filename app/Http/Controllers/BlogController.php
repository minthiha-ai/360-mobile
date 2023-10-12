<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use PHPUnit\Util\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $blogs = Blog::when(isset($request->keyword),function ($q) use ($request){
            return $q
                ->orWhere('title','LIKE',"%$request->keyword%")->orWhere('subTitle','LIKE',"%$request->keyword%");

        })->latest()->paginate(10);

        return  view('Dashboard.Blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Blog.create');
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
            'title' => 'required',
            'subTitle' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->subTitle = $request->subTitle;
        $blog->description = $request->description;

            if($request->hasFile('photo')){
                $images = $request->file('photo');
                $path = 'public/blog_photo';
                if(!Storage::exists($path)){
                    Storage::makeDirectory($path);
                }
                foreach ($images as $img) {
                    $newName  = uniqid().$img->getClientOriginalName();
                    Storage::putFileAs($path,$img,$newName);

                    $blog->photo = $newName;
                }
            }

            $blog->save();
            return redirect()->route('blog.index')->with('message',['icon' => 'success', 'text' => $blog->title . ' is successfully created!']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('Dashboard.Blog.detail')->with(['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
        return view('Dashboard.Blog.edit')->with(['blog'=>$blog]);
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
        $this->validate($request, [
            'title' => 'required',
            'subTitle' => 'required',
            'description' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->subTitle = $request->subTitle;
        $blog->description = $request->description;

            if($request->hasFile('photo')){
                $images = $request->file('photo');
                $path = 'public/blog_photo';
                if(!Storage::exists($path)){
                    Storage::makeDirectory($path);
                }
                foreach ($images as $img) {
                    $newName  = uniqid().$img->getClientOriginalName();
                    Storage::putFileAs($path,$img,$newName);

                    $blog->photo = $newName;
                }
            }

            $blog->save();
            return redirect()->route('blog.index')->with('message',['icon' => 'success', 'text' => $blog->title . ' is successfully updated!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->back()->with('message',['icon' => 'success', 'text' => "$blog->title is Successfully Deleted!"]);
    }
}
