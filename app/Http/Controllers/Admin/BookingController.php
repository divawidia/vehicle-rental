<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Transmission;
use App\Models\Vehicle;
use App\Models\VehicleType;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Booking::with(['vehicle']);

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('bookings.edit', $item->id) . '">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('bookings.show', $item->id) . '">Detail</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('booking-invoice', $item->id) . '">Invoice</a>
                                </li>
                                <li>
                                <form action="' . route('bookings.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->editColumn('booking_status', function ($item){
                        if ($item->booking_status == 'Selesai') {
                            $badge = '<span class="badge bg-success">' . $item->booking_status; '</span>';
                        }elseif ($item->booking_status == 'Sedang Disewa'){
                            $badge = '<span class="badge bg-warning">' . $item->booking_status; '</span>';
                        }else{
                            $badge = '<span class="badge bg-danger">' . $item->booking_status; '</span>';
                        }
                    return $badge;
                })
                ->editColumn('transaction_status', function ($item){
                    if ($item->transaction_status == 'Belum Dibayar') {
                        $badge = '<span class="badge bg-warning">' . $item->transaction_status; '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->transaction_status; '</span>';
                    }
                    return $badge;
                })
                ->editColumn('shipping_status', function ($item){
                    if ($item->shipping_status == 'Belum') {
                        $badge = '<span class="badge bg-warning">' . $item->shipping_status; '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->shipping_status; '</span>';
                    }
                    return $badge;
                })
                ->editColumn('return_status', function ($item){
                    if ($item->return_status == 'Belum') {
                        $badge = '<span class="badge bg-warning">' . $item->return_status; '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->return_status; '</span>';
                    }
                    return $badge;
                })
                ->editColumn('created_at', function ($item){
                    $date = strtotime($item->created_at);
                    return date('l, M d, Y. h:i A',$date);
                })
                ->editColumn('pick_up_datetime', function ($item){
                    $date = strtotime($item->pick_up_datetime);
                    return date('l, M d, Y. h:i A',$date);
                })
                ->editColumn('return_datetime', function ($item){
                    $date = strtotime($item->return_datetime);
                    return date('l, M d, Y. h:i A',$date);
                })
                ->editColumn('whatsapp', function ($item){
                    return '<a
                        href="https://wa.me/' . $item->no_hp_wa .'"
                        class="btn btn-success mx-1 my-1"
                    ><i class="bx bxl-whatsapp"></i></a>';
                })
                ->editColumn('name', function ($item){
                    return '<p>' . $item->first_name . ' ' . $item->last_name . '</p>';
                })
                ->editColumn('total_days_rent', function ($item){
                    return '<p>' . $item->total_days_rent . ' Hari</p>';
                })
                ->editColumn('total_price', function ($item){
                    return 'Rp. ' . number_format($item->total_price);
                })
                ->rawColumns(['action', 'booking_status', 'transaction_status', 'shipping_status', 'return_status', 'created_at', 'pick_up_datetime', 'return_datetime', 'whatsapp', 'name', 'total_days_rent'])
                ->make();
        }

        return view('pages.admin.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::where('unit_quantity', '>', 0)
                            ->get();

        return view('pages.admin.booking.create', [
            'vehicles' => $vehicles
        ]);
    }

    public function userPageBooking1(Request $request){
        $booking = $request->session()->get('booking');
        $vehicleTypes = VehicleType::all();
        $vehicles = Vehicle::with('photos', 'transmission', 'vehicle_type', 'brand')->get();

        return view('pages.home', compact(['booking', 'vehicleTypes', 'vehicles']));
    }

    public function postUserPageBooking1(Request $request){
        $validatedData = $request->validate([
            'vehicle_type_id' => 'required',
            'pick_up_loc' => 'required',
            'return_loc' => 'required',
            'pick_up_datetime' => 'required',
            'return_datetime' => 'required',
            'latitude_pickup' => 'required',
            'longitude_pickup' => 'required',
            'latitude_return' => 'required',
            'longitude_return' => 'required',
        ]);

//        $booking = new Booking();
//        $vehicle = $validatedData['vehicle_type_id'];

//        $booking->fill($validatedData);
        $request->session()->put('booking', $validatedData);

        return redirect()->route('choose-vehicle');
    }

    public function userPageBooking2(Request $request){
        $booking = $request->session()->get('booking');

        $vehicles = Vehicle::where('vehicle_type_id', $booking['vehicle_type_id'])->get();

        return view('pages.choose-vehicle', compact('booking', 'vehicles'));
    }

    public function postUserPageBooking2(Request $request){

        $data = $request->all();
        $booking = $request->session()->get('booking');

        $response_pickup = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    =>'Batur Sari Rental',
                'destinations' => $booking['pick_up_loc'],
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();
        $response_return = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    => $booking['return_loc'],
                'destinations' => 'Batur Sari Rental',
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();

        $response_pickup = json_decode($response_pickup, true);
        $distance_pickup = $response_pickup["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $rounded_distance_pickup = round($distance_pickup);

        $response_return = json_decode($response_return, true);
        $distance_return = $response_return["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $rounded_distance_return = round($distance_return);

        $pickup_date = new DateTime($booking['pick_up_datetime']);
        $return_date = new DateTime($booking['return_datetime']);
        $total_days_rent = $pickup_date->diff($return_date)->format('%a');
        $vehicle = Vehicle::where('id', $request->vehicle_id)->get();
//        dd($total_days_rent);
        $month_rent = 0;
        $monthly_rent_price = 0;
        $week_rent = 0;
        $weekly_rent_price = 0;

//        if ($total_days_rent >= 7 && $total_days_rent < 30){
//            $week_rent = floor($total_days_rent/7);
//            $weekly_rent_price = $vehicle[0]['weekly_price'] * $week_rent;
//
//            $days_rent = $total_days_rent-($week_rent*7);
//            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;
//
//            $rent_price = $weekly_rent_price + $daily_rent_price;
//
//        }
        if ($total_days_rent >= 30){
            $month_rent = floor($total_days_rent/30);
            $monthly_rent_price = $vehicle[0]['monthly_price'] * $month_rent;

            $days_rent = $total_days_rent-($month_rent*30);
            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;

            $rent_price = $monthly_rent_price + $daily_rent_price;
        } else {
            $days_rent = $total_days_rent;
            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;

            $rent_price = $daily_rent_price;
        }

        if ($rounded_distance_pickup <= 5){
            $shipping_price = 0;
        }else{
            $distance_pickup_pay = $rounded_distance_pickup - 5;
            $shipping_price = $distance_pickup_pay * 10000;
        }

        if ($rounded_distance_return <= 5){
            $collection_price = 0;
        }else{
            $distance_return_pay = $rounded_distance_return - 5;
            $collection_price = $distance_return_pay * 10000;
        }

        if ($request->insurance){
            $insurance_price = $rent_price * 25/100;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        } else{
            $insurance_price = 0;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        }

        $data['total_days_rent'] = $total_days_rent;
        $data['month_rent'] = $month_rent;
        $data['monthly_rent_price'] = $monthly_rent_price;
        $data['week_rent'] = $week_rent;
        $data['weekly_rent_price'] = $weekly_rent_price;
        $data['day_rent'] = $days_rent;
        $data['daily_rent_price'] = $daily_rent_price;
        $data['insurance_price'] = $insurance_price;
        $data['shipping_price'] = $shipping_price;
        $data['collection_price'] = $collection_price;
        $data['booking_price'] = $rent_price;
        $data['total_price'] = $total_price;
        $data['distance_pickup'] = $distance_pickup;
        $data['rounded_distance_pickup'] = $rounded_distance_pickup;
        $data['distance_return'] = $distance_return;
        $data['rounded_distance_return'] = $rounded_distance_return;

        $data['pick_up_loc'] = $booking['pick_up_loc'];
        $data['return_loc'] = $booking['return_loc'];
        $data['latitude_pickup'] = $booking['latitude_pickup'];
        $data['longitude_pickup'] = $booking['longitude_pickup'];
        $data['latitude_return'] = $booking['latitude_return'];
        $data['longitude_return'] = $booking['longitude_return'];
        $data['pick_up_datetime'] = $booking['pick_up_datetime'];
        $data['return_datetime'] = $booking['return_datetime'];

        $newBooking = new Booking();

        $newBooking->fill($data);
        $request->session()->put('booking', $newBooking);

        return redirect()->route('booking-payment');
    }

    public function userPageBooking3(Request $request){
        $booking = $request->session()->get('booking');

        return view('pages.payment', compact('booking'));
    }

    public function postUserPageBooking3(Request $request){
        $data = $request->all();
        $booking = $request->session()->get('booking');

        if ($request->transaction_type == 'COD') {
            $booking->fill($data);
            $booking->save();
//        dd($booking);
            return redirect()->route('finish-payment');
        }elseif ($request->transaction_type == 'Transfer'){
            $code = 'RENT-' . mt_rand(00000, 999999);

            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            $midtrans = [
                'transaction_details' => [
                    'order_id' => $code,
                    'gross_amount' => (int) $booking['total_price'],
                ],
                'customer_details' => [
                    'first_name' => $booking['first_name'],
                    'email' => $booking['email']
                ],
                'enabled_payments' => [
                    'gopay', 'credit_card', 'bank_transfer'
                ],
                'vtweb' => []
            ];

            try {
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

                return redirect($paymentUrl);
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function userPageBooking4(Request $request){
        $booking = $request->session()->get('booking');

        return view('pages.finish-payment', compact('booking'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

//        $origin = '';
        $response_pickup = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    =>'Batur Sari Rental',
                'destinations' => $data['pick_up_loc'],
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();
        $response_return = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    => $data['return_loc'],
                'destinations' => 'Batur Sari Rental',
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();

        $response_pickup = json_decode($response_pickup, true);
        $distance_pickup = $response_pickup["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $rounded_distance_pickup = round($distance_pickup);

        $response_return = json_decode($response_return, true);
        $distance_return = $response_return["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $rounded_distance_return = round($distance_return);

        $pickup_date = new DateTime($request->pick_up_datetime);
        $return_date = new DateTime($request->return_datetime);
        $total_days_rent = $pickup_date->diff($return_date)->format('%a');
        $vehicle = Vehicle::where('id', $request->vehicle_id)->get();

        $month_rent = 0;
        $monthly_rent_price = 0;
        $week_rent = 0;
        $weekly_rent_price = 0;

//        if ($total_days_rent >= 7 && $total_days_rent < 30){
//            $week_rent = floor($total_days_rent/7);
//            $weekly_rent_price = $vehicle[0]['weekly_price'] * $week_rent;
//
//            $days_rent = $total_days_rent-($week_rent*7);
//            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;
//
//            $rent_price = $weekly_rent_price + $daily_rent_price;
//        }
        if ($total_days_rent >= 30){
            $month_rent = floor($total_days_rent/30);
            $monthly_rent_price = $vehicle[0]['monthly_price'] * $month_rent;

            $days_rent = $total_days_rent-($month_rent*30);
            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;

            $rent_price = $monthly_rent_price + $daily_rent_price;
        } else {
            $days_rent = $total_days_rent;
            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;

            $rent_price = $daily_rent_price;
        }

        if ($rounded_distance_pickup <= 5){
            $shipping_price = 0;
        }else{
            $distance_pickup_pay = $rounded_distance_pickup - 5;
            $shipping_price = $distance_pickup_pay * 10000;
        }

        if ($rounded_distance_return <= 5){
            $collection_price = 0;
        }else{
            $distance_return_pay = $rounded_distance_return - 5;
            $collection_price = $distance_return_pay * 10000;
        }

        if ($request->insurance){
            $insurance_price = $rent_price * 25/100;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        } else{
            $insurance_price = 0;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        }

        $data['total_days_rent'] = $total_days_rent;
        $data['month_rent'] = $month_rent;
        $data['monthly_rent_price'] = $monthly_rent_price;
        $data['week_rent'] = $week_rent;
        $data['weekly_rent_price'] = $weekly_rent_price;
        $data['day_rent'] = $days_rent;
        $data['daily_rent_price'] = $daily_rent_price;
        $data['insurance_price'] = $insurance_price;
        $data['shipping_price'] = $shipping_price;
        $data['collection_price'] = $collection_price;
        $data['booking_price'] = $rent_price;
        $data['total_price'] = $total_price;
        $data['distance_pickup'] = $distance_pickup;
        $data['rounded_distance_pickup'] = $rounded_distance_pickup;
        $data['distance_return'] = $distance_return;
        $data['rounded_distance_return'] = $rounded_distance_return;

        $booking = Booking::create($data);

        Vehicle::find($request->vehicle_id)->decrement('unit_quantity', 1);

//        dd($month_rent, $monthly_rent_price, $week_rent, $weekly_rent_price, $days_left, $daily_rent_price, $insurance_price, $total_price);

        return redirect()->route('bookings.show', [$booking->id])->with('status', 'Data Booking berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.admin.booking.detail')->with('booking', Booking::where('id', $id)->first());
    }

    public function invoice(string $id)
    {
        return view('pages.admin.booking.invoice')->with('booking', Booking::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        $vehicles = Vehicle::all();

        return view('pages.admin.booking.edit', [
            'booking' => $booking,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->has('insurance')){
            $insurance_status = $request->insurance = 'include';
        }else{
            $insurance_status = $request->insurance = 'not include';
        }

        if ($request->has('first_aid_kit')){
            $first_aid_kit_status = $request->first_aid_kit = 'include';
        }else{
            $first_aid_kit_status = $request->first_aid_kit = 'not include';
        }

        if ($request->has('phone_holder')){
            $phone_holder_status = $request->phone_holder = 'include';
        }else{
            $phone_holder_status = $request->phone_holder = 'not include';
        }

        if ($request->has('raincoat')){
            $raincoat_status = $request->raincoat = 'include';
        }else{
            $raincoat_status = $request->raincoat = 'not include';
        }

        $response_pickup = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    =>'Batur Sari Rental',
                'destinations' => $request->pick_up_loc,
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();
        $response_return = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    => $request->return_loc,
                'destinations' => 'Batur Sari Rental',
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();

        $response_pickup = json_decode($response_pickup, true);
        $distance_pickup = $response_pickup["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $rounded_distance_pickup = round($distance_pickup);

        $response_return = json_decode($response_return, true);
        $distance_return = $response_return["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $rounded_distance_return = round($distance_return);

        $pickup_date = new DateTime($request->pick_up_datetime);
        $return_date = new DateTime($request->return_datetime);
        $total_days_rent = $pickup_date->diff($return_date)->format('%a');
        $vehicle = Vehicle::where('id', $request->vehicle_id)->get();

        $month_rent = 0;
        $monthly_rent_price = 0;
        $week_rent = 0;
        $weekly_rent_price = 0;

//        if ($total_days_rent >= 7 && $total_days_rent < 30){
//            $week_rent = floor($total_days_rent/7);
//            $weekly_rent_price = $vehicle[0]['weekly_price'] * $week_rent;
//
//            $days_rent = $total_days_rent-($week_rent*7);
//            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;
//
//            $rent_price = $weekly_rent_price + $daily_rent_price;
//
//        }
        if ($total_days_rent >= 30){
            $month_rent = floor($total_days_rent/30);
            $monthly_rent_price = $vehicle[0]['monthly_price'] * $month_rent;

            $days_rent = $total_days_rent-($month_rent*30);
            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;

            $rent_price = $monthly_rent_price + $daily_rent_price;
        } else {
            $days_rent = $total_days_rent;
            $daily_rent_price = $vehicle[0]['daily_price'] * $days_rent;

            $rent_price = $daily_rent_price;
        }

        if ($rounded_distance_pickup <= 5){
            $shipping_price = 0;
        }else{
            $distance_pickup_pay = $rounded_distance_pickup - 5;
            $shipping_price = $distance_pickup_pay * 10000;
        }

        if ($rounded_distance_return <= 5){
            $collection_price = 0;
        }else{
            $distance_return_pay = $rounded_distance_return - 5;
            $collection_price = $distance_return_pay * 10000;
        }

        if ($request->insurance == 'include'){
            $insurance_price = $rent_price * 25/100;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        } else{
            $insurance_price = 0;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        }

        if ($request->booking_status == 'Selesai' || $request->booking_status == 'Batal' || $request->transaction_status == 'Batal' || $request->return_status == 'Sudah'){
            Vehicle::find($request->vehicle_id)->increment('unit_quantity', 1);
        }

        $data = $request->all();
        $data['insurance'] = $insurance_status;
        $data['first_aid_kit'] = $first_aid_kit_status;
        $data['phone_holder'] = $phone_holder_status;
        $data['raincoat'] = $raincoat_status;
        $data['total_days_rent'] = $total_days_rent;
        $data['month_rent'] = $month_rent;
        $data['monthly_rent_price'] = $monthly_rent_price;
        $data['week_rent'] = $week_rent;
        $data['weekly_rent_price'] = $weekly_rent_price;
        $data['day_rent'] = $days_rent;
        $data['daily_rent_price'] = $daily_rent_price;
        $data['insurance_price'] = $insurance_price;
        $data['shipping_price'] = $shipping_price;
        $data['collection_price'] = $collection_price;
        $data['booking_price'] = $rent_price;
        $data['total_price'] = $total_price;
        $data['distance_pickup'] = $distance_pickup;
        $data['rounded_distance_pickup'] = $rounded_distance_pickup;
        $data['distance_return'] = $distance_return;
        $data['rounded_distance_return'] = $rounded_distance_return;

        $booking = Booking::findOrFail($id);

        $booking->update($data);

        return redirect()->route('bookings.show', [$booking->id])->with('status', 'Data Booking berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Booking::findOrFail($id);
        $item->delete();

        return redirect()->route('bookings.index')->with('status', 'Data Booking berhasil dihapus!');
    }
}
