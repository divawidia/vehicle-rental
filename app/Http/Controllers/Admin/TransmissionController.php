<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TransmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transmission::query();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('transmisi.edit', $item->id) . '">Edit</a>
                                </li>
                                <li>
                                <form action="' . route('transmisi.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.admin.vehicle-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.vehicle-category.transmission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->transmission_type);

        Transmission::create($data);

        return redirect()->route('vehicle-category-index')->with('status', 'Data Transmisi berhasil ditambahkan!');
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
        $item = Transmission::findOrFail($id);

        return view('pages.admin.vehicle-category.transmission.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->transmission_type);

        $item = Transmission::findOrFail($id);
        $item->update($data);

        return redirect()->route('vehicle-category-index')->with('status', 'Data Transmisi berhasil dupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Transmission::findOrFail($id);
        $item->delete();

        return redirect()->route('vehicle-category-index')->with('status', 'Data Transmisi berhasil dihapus!');
    }
}
