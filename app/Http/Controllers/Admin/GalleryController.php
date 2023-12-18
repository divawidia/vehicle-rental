<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Vehicle;
use App\Models\VehiclePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Gallery::with(['user']);

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <form action="' . route('galleries.destroy', $item->id) . '" method="POST">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger mx-1 my-1">
                                Hapus
                            </button>
                        </form>';
                })
                ->editColumn('photo_url', function ($item) {
                    return $item->photo_url ? '<img src="' . Storage::url($item->photo_url) . '" style="max-height: 80px;"/>' : '';
                })
                ->editColumn('created_at', function ($item){
                    $date = strtotime($item->created_at);
                    return date('l, M d, Y',$date);
                })
                ->rawColumns(['action', 'photo_url', 'created_at'])
                ->make();
        }

        return view('admin.pages.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.gallery.create');
    }

    public function uploadPhoto(Request $request) {
        $data = [];
        $data['photo_url'] = $request->file('file')->store('assets/gallery', 'public');
        $data['user_id'] = Auth::user()->id;
        Gallery::create($data);
        return response()->json(['success'=>$data['photo_url']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['photo_url'] = $request->file('photo_url')->store('assets/vehicle-photo', 'public');

        VehiclePhoto::create($data);

        return redirect()->route('galleries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Gallery::findorFail($id);
        $item->delete();

        return redirect()->route('galleries.index');
    }
}
