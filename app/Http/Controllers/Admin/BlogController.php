<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogPhoto;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with(['user', 'photos', 'categories'])->get();
        return view('pages.admin.blog.index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();

        return view('pages.admin.blog.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = Auth::user()->id;

        $blog = Blog::create($data);

        $gallery = [
            'blog_id' => $blog->id,
            'photo_url' => $request->file('photo_url')->store('assets/blog-photo', 'public')
        ];

        BlogPhoto::create($gallery);

        return redirect()->route('blogs.index')->with('status', 'Data artikel blog berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('pages.admin.blog.detail')->with('blog', Blog::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $blog = Blog::with((['photos', 'categories']))->findOrFail($slug);
        $categories = BlogCategory::all();

        return view('pages.admin.vehicle.edit',[
            'blog' => $blog,
            'categories' => $categories
        ]);
    }

    public function uploadPhoto(Request $request){
        $data = $request->all();

        $data['photo_url'] = $request->file('photo_url')->store('assets/blog-photo', 'public');

        BlogPhoto::create($data);

        return redirect()->route('blogs.edit', $request->slug);
    }

    public function deletePhoto(Request $request, $id)
    {
        $item = BlogPhoto::findOrFail($id);
        $item->delete();

        return redirect()->route('blogs.edit', $item->blog->slug);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $data = $request->all();

        $blog = Blog::findOrFail($slug);

        $data['slug'] = Str::slug($request->title);

        $blog->update($data);

        return redirect()->route('blogs.index')->with('status', 'Data artikel blog berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $blog = Blog::findOrFail($slug);
        $blog->delete();

        return redirect()->route('blogs.index')->with('status', 'Data artikel blog berhasil dihapus!');
    }
}
