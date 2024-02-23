<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Promo::query()->where('type', '=','sale')->latest()->get();
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('sales.edit', $item->id) . '">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('sales.show', $item->id) . '">Detail</a>
                                </li>
                                <li>
                                <form action="' . route('sales.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->editColumn('starts_at', function ($item){
                    $date = strtotime($item->starts_at);
                    return date('l, M d, Y',$date);
                })
                ->editColumn('expires_at', function ($item){
                    $date = strtotime($item->expires_at);
                    return date('l, M d, Y',$date);
                })
                ->editColumn('status', function ($item){
                    if ($item->status == 1) {
                        $badge = '<span class="badge bg-success">Aktif</span>';
                    }else{
                        $badge = '<span class="badge badge-warning">Tidak Aktif</span>';
                    }
                    return $badge;
                })
                ->rawColumns(['action', 'starts_at', 'expires_at', 'status'])
                ->make();
        }

        return view('pages.admin.promo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        return view('pages.admin.promo.sale.create',[
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['type'] = 'sale';
        $data['uses'] = 0;
        $sale = Promo::create($data);
        $sale->vehicles()->sync((array)$request->input('vehicle_id'));

        return redirect()->route('promo-index')->with('status', 'Promo diskon kendaraan berhasil ditambahkan!');
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
        $promo = Promo::findOrFail($id);

        return view('pages.admin.promo.sale.edit', [
            'promo' => $promo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $data['type'] = 'sale';
        $sale = Promo::findOrFail($id);
        $sale->update($data);
        $sale->vehicles()->sync((array)$request->input('vehicle_id'));

        return redirect()->route('promo-index')->with('status', 'Promo diskon kendaraan berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Promo::findOrFail($id);
        $item->delete();

        return redirect()->route('promo-index')->with('status', 'Promo diskon kendaraan berhasil ditambahkan!');
    }
}
