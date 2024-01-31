<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Tag;
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
        $blogs = Blog::with(['user', 'tags'])->get();
        return view('pages.admin.blog.index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();

        return view('pages.admin.blog.create',[
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = Auth::user()->id;
        $data['thumbnail_photo'] = $request->file('thumbnail_photo')->store('assets/blog-thumbnail', 'public');

        $blog = Blog::create($data);
        $blog->tags()->sync((array)$request->input('tag_id'));

        return redirect()->route('artikel.index')->with('status', 'Data artikel blog berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('pages.admin.blog.detail')->with('blog', Blog::where('slug', $slug)->where('deleted_at', null)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = Blog::with((['tags']))->findOrFail($id);
        $tags = Tag::all();

        return view('pages.admin.blog.edit',[
            'artikel' => $artikel,
            'tags' => $tags
        ]);
    }

//    public function uploadPhotoThumbnail(Request $request){
//        $data = $request->all();
//        $data['thumbnail_photo'] = $request->file('thumbnail_photo')->store('assets/blog-thumbnail', 'public');
//        BlogPhoto::create($data);
//        return redirect()->route('artikel-blog.edit', $data['blog_id']);
//    }

//    public function uploadPhoto(BlogRequest $request, Blog $blog){
//        if ($request->hasFile('upload')) {
//            $originName = $request->file('upload')->getClientOriginalName();
//            $fileName = pathinfo($originName, PATHINFO_FILENAME);
//            $extension = $request->file('upload')->getClientOriginalExtension();
//            $fileName = $fileName . '_' . time() . '.' . $extension;
//
//            $request->file('upload')->move(public_path('assets/blog-photo'), $fileName);
//
//            $url = asset('assets/blog-photo/' . $fileName);
//            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
//
//        }
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $artikel)
    {
        $data = $request->validated();

        $blog = Blog::findOrFail($artikel->id);

        $data['slug'] = Str::slug($request->title);
        $data['thumbnail_photo'] = $request->file('thumbnail_photo')->store('assets/blog-thumbnail', 'public');

        $blog->update($data);
        $blog->tags()->sync((array)$request->input('tag_id'));

        return redirect()->route('artikel.index')->with('status', 'Data artikel blog berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->categories()->detach();
        $blog->delete();

        return redirect()->route('artikel.index')->with('status', 'Data artikel blog berhasil dihapus!');
    }
}
