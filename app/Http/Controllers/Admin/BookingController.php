<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmationCashMail;
use App\Mail\BookingConfirmationTrfMail;
use App\Mail\PayBookingTrfMail;
use App\Models\Booking;
use App\Models\Promo;
use App\Models\Transmission;
use App\Models\Vehicle;
use App\Models\VehicleDetail;
use App\Models\VehicleType;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
            $query = Booking::with(['vehicle', 'vehicle_detail'])->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('admin.bookings.edit', $item->id) . '">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('admin.bookings.show', $item->id) . '">Detail</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('admin.bookings.invoice', $item->id) . '">Invoice</a>
                                </li>
                                <li>
                                <form action="' . route('admin.bookings.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->editColumn('rent_status', function ($item){
                        if ($item->rent_status == 'Selesai') {
                            $badge = '<span class="badge bg-success">' . $item->rent_status . '</span>';
                        }elseif ($item->rent_status == 'Disewa'){
                            $badge = '<span class="badge bg-warning">' . $item->rent_status . '</span>';
                        }elseif ($item->rent_status == 'Dibooking'){
                            $badge = '<span class="badge bg-secondary">' . $item->rent_status . '</span>';
                        }else{
                            $badge = '<span class="badge bg-danger">' . $item->rent_status . '</span>';
                        }
                    return $badge;
                })
                ->editColumn('transaction_status', function ($item){
                    if ($item->transaction_status == 'Belum Dibayar') {
                        $badge = '<span class="badge bg-warning">' . $item->transaction_status . '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->transaction_status . '</span>';
                    }
                    return $badge;
                })
                ->editColumn('shipping_status', function ($item){
                    if ($item->shipping_status == 'Belum') {
                        $badge = '<span class="badge bg-warning">' . $item->shipping_status . '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->shipping_status . '</span>';
                    }
                    return $badge;
                })
                ->editColumn('return_status', function ($item){
                    if ($item->return_status == 'Belum') {
                        $badge = '<span class="badge bg-warning">' . $item->return_status . '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->return_status . '</span>';
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
                        href="https://wa.me/' . trim($item->no_hp_wa, "+") .'"
                        class="btn btn-success mx-1 my-1"
                    ><i class="bx bxl-whatsapp"></i></a>';
                })
                ->editColumn('maps_pickup', function ($item){
                    return '<a
                        href="https://www.google.com/maps/search/?api=1&query=' . $item->latitude_pickup . '%2C' . $item->longitude_pickup . '"
                        class="btn btn-primary mx-1 my-1"
                    ><i class="bx bx-map"></i></a>';
                })
                ->editColumn('maps_return', function ($item){
                    return '<a
                        href="https://www.google.com/maps/search/?api=1&query=' . $item->latitude_return . '%2C' . $item->longitude_return . '"
                        class="btn btn-primary mx-1 my-1"
                    ><i class="bx bx-map"></i></a>';
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
                ->rawColumns(['action', 'rent_status', 'transaction_status', 'shipping_status', 'return_status', 'created_at', 'pick_up_datetime', 'return_datetime', 'whatsapp', 'maps_pickup', 'maps_return', 'name', 'total_days_rent'])
                ->addIndexColumn()
                ->make();
        }

        return view('admin.pages.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        $vehicles = DB::table('vehicles')
//            ->join('vehicle_details', 'vehicles.id','=','vehicle_details.vehicle_id')
//            ->select('vehicles.*', DB::raw('COUNT(vehicle_details.id) as unit_available'))
//            ->where('vehicle_details.status', '=', 'tersedia')
//            ->groupBy('vehicles.id')
//            ->get();
        $vehicles = Vehicle::where('unit_quantity', '>', 0)->get();

        return view('admin.pages.booking.create', [
            'vehicles' => $vehicles
        ]);
    }

    public function userPageBooking1(Request $request){
        $booking = $request->session()->get('booking');
        $vehicleTypes = VehicleType::all();
        $vehicles = Vehicle::with('photos', 'transmission', 'vehicle_type', 'brand')->get();

        return view('client.pages.home', compact(['booking', 'vehicleTypes', 'vehicles']));
    }

    public function postUserPageBooking1(Request $request){
        $validatedData = $request->validate([
            'vehicle_type_id' => 'required',
            'pickup_location_type' => 'required',
            'return_location_type' => 'required',
            'pick_up_loc' => '',
            'return_loc' => '',
            'pick_up_date' => 'required|date',
            'pick_up_time' => 'required|date_format:H:i',
            'return_date' => 'required|date',
            'return_time' => 'required|date_format:H:i',
            'latitude_pickup' => 'required',
            'longitude_pickup' => 'required',
            'latitude_return' => 'required',
            'longitude_return' => 'required',
        ],[
            'vehicle_type_id.required' => 'Please choose vehicle type!',
            'pickup_location_type.required' => 'Please choose delivery location!',
            'return_location_type.required' => 'Please choose return location!'
//            'body.required' => 'A message is required',
        ]);

        $request->session()->put('booking', $validatedData);

        return redirect()->route('choose-vehicle');
    }

    public function userPageBooking2(Request $request){
        $booking = $request->session()->get('booking');

//        $vehicles = DB::table('vehicles')
//                        ->join('vehicle_details', 'vehicles.id','=','vehicle_details.vehicle_id')
//                        ->select('vehicles.*', DB::raw('COUNT(vehicle_details.id) as unit_available'))
//                        ->where('vehicle_details.status', '=', 'tersedia')
//                        ->where('vehicles.vehicle_type_id', '=', $booking['vehicle_type_id'])
//                        ->groupBy('vehicles.id')
//                        ->get();
        $vehicles = Vehicle::where('unit_quantity', '>', 0)->get();

        return view('client.pages.choose-vehicle', compact('booking', 'vehicles'));
    }

//    public function checkVoucher(Request $request){
//        if (Promo::where('code', '=', $request->voucher)
//            ->where('uses', '<=', 'max_uses')
//            ->where('starts_at', '>=', Carbon::today())
//            ->where('expires_at', '<=', Carbon::today())
//            ->where('status', 1)
//            ->exist()){
//            $promo = Promo::where('code', '=', $request->voucher)->first();
//            $discount_price = $total_price * $promo->discount_amount;
//            $total_price = $total_price - $discount_price;
//        }
//    }

    public function getRentPrice(Request $request){
        $data = $request->all();
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

        $pickup_date = new DateTime($data['pick_up_date']);
        $return_date = new DateTime($data['return_date']);
        $total_days_rent = $pickup_date->diff($return_date)->format('%a');
        $vehicle = Vehicle::where('id', $request->vehicle_id)->first();
//        dd($vehicle->promos[0]);
        if (!$vehicle->promos->isEmpty()){
            foreach ($vehicle->promos as $promo){
                $discount_status = $promo->status;
                $discount_percentage = $promo->discount_amount;
                $discount_daily = $vehicle->daily_price * $discount_percentage / 100;
                $vehicle['daily_price'] = $vehicle->daily_price - $discount_daily;
                $discount_monthly = $vehicle->monthly_price * $discount_percentage / 100;
                $vehicle['monthly_price'] = $vehicle->monthly_price - $discount_monthly;
            }
        }else{
            $discount_status = '0';
        }

        $month_rent = 0;
        $monthly_rent_price = 0;
        $week_rent = 0;
        $weekly_rent_price = 0;

        if ($total_days_rent >= 30){
            $month_rent = floor($total_days_rent/30);
            $monthly_rent_price = $vehicle['monthly_price'] * $month_rent;

            $days_rent = $total_days_rent-($month_rent*30);
            $daily_rent_price = $vehicle['daily_price'] * $days_rent;

            $rent_price = $monthly_rent_price + $daily_rent_price;
        } else {
            $days_rent = $total_days_rent;
            $daily_rent_price = $vehicle['daily_price'] * $days_rent;

            $rent_price = $daily_rent_price;
        }

        if ($rounded_distance_pickup <= 5){
            $shipping_price = 0;
        }else{
            $distance_pickup_pay = $rounded_distance_pickup - 5;
            $shipping_price = $distance_pickup_pay * 10000;
        }

        $collection_price = 0;

        if ($request->insurance){
            $insurance_price = $rent_price * 25/100;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        } else{
            $insurance_price = 0;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        }

        if ($request->voucher) {
            $promo = Promo::where('code', '=', $request->voucher)->first();
            $today = Carbon::today()->format('Y-m-d H:i:s');
//            dd(Promo::where('code', '=', $request->voucher)->where('expires_at', '>', $today)->first());
            if (DB::table('promos')
                ->where('code', '=', $request->voucher)
                ->where('uses', '<', $promo->max_uses)
                ->where('starts_at', '<=', Carbon::today()->toDateString())
                ->where('expires_at', '>=', $today)
                ->where('status', '=', '1')
                ->exists()){
                $promo = Promo::where('code', '=', $request->voucher)->first();
                $discount_price = $total_price * $promo->discount_amount / 100;
                $total_price = $total_price - $discount_price;
                $data['discount'] = $promo->discount_amount;
                $data['discount_price'] = $discount_price;
                $message = 'Your voucher code are valid';
            }else{
                $message = 'Your voucher code are invalid';
            }
        }else{
            $message = 'success';
        }

        $data['vehicle_name'] = $vehicle->vehicle_name;
        $data['vehicle_daily_price'] = $vehicle->daily_price;
        $data['vehicle_year'] = $vehicle->year;
        $data['vehicle_color'] = $vehicle->color;
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
        $data['rounded_distance_pickup'] = $rounded_distance_pickup;

        return response()->json([$data, 'message' => $message]);
    }

    public function postUserPageBooking2(Request $request){

        $data = $request->all();
        $booking = $request->session()->get('booking');

        $response_pickup = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    =>'Batur Sari Rental',
                'destinations' => $booking['latitude_pickup'] .','. $booking['longitude_pickup'],
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();
        $response_return = \GoogleMaps::load('distancematrix')
            ->setParam ([
                'origins'    => 'Batur Sari Rental',
                'destinations' => $booking['latitude_return'] .','. $booking['longitude_return'],
                'units' => 'metrics',
                'mode' => 'driving ',
                'avoid' => 'tolls'
            ])
            ->get();

        $response_pickup = json_decode($response_pickup, true);
        $distance_pickup = $response_pickup["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $pickup_loc = $response_pickup["destination_addresses"][0];
        $rounded_distance_pickup = round($distance_pickup);
//        dd($pickup_loc);

        $response_return = json_decode($response_return, true);
        $distance_return = $response_return["rows"][0]["elements"][0]["distance"]["value"] / 1000;
        $return_loc = $response_return["destination_addresses"][0];
        $rounded_distance_return = round($distance_return);

        $pickup_date = new DateTime($booking['pick_up_date']);
        $return_date = new DateTime($booking['return_date']);
        $total_days_rent = $pickup_date->diff($return_date)->format('%a');
        $vehicle = Vehicle::where('id', $request->vehicle_id)->first();
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
            $monthly_rent_price = $vehicle['monthly_price'] * $month_rent;

            $days_rent = $total_days_rent-($month_rent*30);
            $daily_rent_price = $vehicle['daily_price'] * $days_rent;

            $rent_price = $monthly_rent_price + $daily_rent_price;
        } else {
            $days_rent = $total_days_rent;
            $daily_rent_price = $vehicle['daily_price'] * $days_rent;

            $rent_price = $daily_rent_price;
        }

        if ($rounded_distance_pickup <= 5){
            $shipping_price = 0;
        }else{
            $distance_pickup_pay = $rounded_distance_pickup - 5;
            $shipping_price = $distance_pickup_pay * 10000;
        }

        $collection_price = 0;

        if ($request->insurance){
            $insurance_price = $rent_price * 25/100;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        } else{
            $insurance_price = 0;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        }

        if ($request->voucher) {
            $promo = Promo::where('code', '=', $request->voucher)->first();
            $today = Carbon::today()->format('Y-m-d H:i:s');
//            dd(Promo::where('code', '=', $request->voucher)->where('expires_at', '>', $today)->first());
            if (DB::table('promos')
                ->where('code', '=', $request->voucher)
                ->where('uses', '<', $promo->max_uses)
                ->where('starts_at', '<=', $today)
                ->where('expires_at', '>=', $today)
                ->where('status', '=', '1')
                ->exists()){
                $promo = Promo::where('code', '=', $request->voucher)->first();
                $discount_price = $total_price * $promo->discount_amount / 100;
                $total_price = $total_price - $discount_price;
                $data['discount_price'] = $discount_price;
                $data['promo_id'] = $promo->id;
                $data['discount'] = $promo->discount_amount;
            }else{
                $data['discount_price'] = 0;
            }
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
        $data['pick_up_loc'] = $pickup_loc;
        $data['return_loc'] = $return_loc;
        $data['latitude_pickup'] = $booking['latitude_pickup'];
        $data['longitude_pickup'] = $booking['longitude_pickup'];
        $data['latitude_return'] = $booking['latitude_return'];
        $data['longitude_return'] = $booking['longitude_return'];
        $data['pick_up_date'] = $booking['pick_up_date'];
        $data['pick_up_time'] = $booking['pick_up_time'];
        $data['return_date'] = $booking['return_date'];
        $data['return_time'] = $booking['return_time'];
        $data['pickup_location_type'] = $booking['pickup_location_type'];
        $data['return_location_type'] = $booking['return_location_type'];

        $vehicleDetail = VehicleDetail::where('vehicle_id', '=', $request->vehicle_id)->where('status', '=', 'tersedia')->first();
        $data['vehicle_detail_id'] = $vehicleDetail->id;

        $newBooking = new Booking();

        $newBooking->fill($data);
        $request->session()->put('booking', $newBooking);
//        dd($newBooking);

        return redirect()->route('booking-payment');
    }

    public function userPageBooking3(Request $request){
        $booking = $request->session()->get('booking');

        return view('pages.payment', compact('booking'));
    }

    public function postUserPageBooking3(Request $request){
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'no_hp_wa' => 'required',
            'email' => 'required|email:rfc,dns',
            'country' => 'required|string',
            'home_address' => 'required|string',
            'transaction_type' => 'required',
        ],[
            'transaction_type.required' => 'Please choose payment method!'
        ]);
        $data['country_code'] = strtoupper($request->country_code);
        $booking = $request->session()->get('booking');

        $code = 'RENT-' . mt_rand(00000, 999999);
        if ($this->transactionCodeExist($code)) {
            $code = 'RENT-' . mt_rand(00000, 999999);
        }

        if ($request->transaction_type == 'COD') {
            $booking->fill($data);
            $booking['transaction_code'] = $code;
            $booking->save();

            DB::table('vehicle_details')
                ->where('id', '=', $booking['vehicle_detail_id'])
                ->update(['status' => 'disewa']);
            if ($booking['promo_id']){
                DB::table('promos')->where('id', $booking['promo_id'])->increment('uses');
            }

            Mail::to($data['email'])->send(new BookingConfirmationCashMail($booking));

            return redirect()->route('finish-payment');
        }elseif ($request->transaction_type == 'Transfer'){
            $booking->fill($data);

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
                $snaptoken = Snap::getSnapToken($midtrans);
                $booking['snap_token'] = $snaptoken;
                $booking['transaction_code'] = $code;
                $booking->save();
                if ($booking['promo_id']){
                    DB::table('promos')->where('id', $booking['promo_id'])->increment('uses');
                }

                Mail::to($data['email'])->send(new PayBookingTrfMail($booking));

                return redirect()->route('pay-booking', $booking->transaction_code);
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }

    function transactionCodeExist($code) {
        return Booking::where('transaction_code', $code)->exists();
    }

    public function payBooking(string $transaction_code){
        $booking = Booking::where('transaction_code', $transaction_code)->first();

        if ($booking->transaction_status == 'Belum Dibayar'){
            return view('pages.transfer-payment', compact('booking'));
        }else{
            return redirect()->route('pay-success', $booking->transaction_code);
        }
    }

    public function updateStatusIfSuccess(string $id, string $transaction_code){
        $booking = Booking::where('id', $id)->where('transaction_code', $transaction_code)->first();
        $booking->transaction_status = 'Sudah Dibayar';
        $booking->update();
        VehicleDetail::where('id', $booking->vehicle_detail_id)->update(['status' => 'disewa']);

        Mail::to($booking->email)->send(new BookingConfirmationTrfMail($booking));

        return response()->json('success',200);
    }
    public function successPayment(string $transaction_code){
        $booking = Booking::where('transaction_code', $transaction_code)->first();
        if ($booking->transaction_status == 'Belum Dibayar'){
            return redirect()->route('pay-booking',$transaction_code);
        }elseif ($booking->transaction_status == 'Sudah Dibayar'){
            return view('pages.finish-payment', compact('booking'));
        }
    }

    public function userPageBooking4(Request $request){
        $booking = $request->session()->get('booking');

        return view('pages.finish-payment', compact('booking'));
    }

    public function fetchVehicleDetail(Request $request){
        $data['vehicleDetails'] = VehicleDetail::where('vehicle_id', $request->vehicle_id)->where('status', 'tersedia')->get();
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

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
                'origins'    => 'Batur Sari Rental',
                'destinations' => $data['return_loc'],
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

        $collection_price = 0;

        if ($request->insurance){
            $insurance_price = $rent_price * 25/100;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        } else{
            $insurance_price = 0;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        }

        if ($request->voucher) {
            $promo = Promo::where('code', '=', $request->voucher)->first();
            $today = Carbon::today()->format('Y-m-d H:i:s');
//            dd(Promo::where('code', '=', $request->voucher)->where('expires_at', '>', $today)->first());
            if (DB::table('promos')
                ->where('code', '=', $request->voucher)
                ->where('uses', '<', $promo->max_uses)
                ->where('starts_at', '<=', $today)
                ->where('expires_at', '>=', $today)
                ->where('status', '=', '1')
                ->exists()){
                $promo = Promo::where('code', '=', $request->voucher)->first();
                $discount_price = $total_price * $promo->discount_amount / 100;
                $total_price = $total_price - $discount_price;
                $data['discount_price'] = $discount_price;
                $data['promo_id'] = $promo->id;
            }else{
                $data['discount_price'] = 0;
            }
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

        DB::table('vehicle_details')
            ->where('id', '=', $request->vehicle_detail_id)
            ->update(['status' => 'disewa']);

        return redirect()->route('bookings.show', [$booking->id])->with('status', 'Data Booking berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.pages.booking.detail')->with('booking', Booking::where('id', $id)->first());
    }

    public function invoice(string $id)
    {
        return view('admin.pages.booking.invoice')->with('booking', Booking::where('id', $id)->first());
    }

    public function invoicePDF(string $id){
        $booking = Booking::findOrFail($id);
        $bookingPDF = [
            'transaction_code' => $booking->transaction_code,
            'transaction_status' => $booking->transaction_status
        ];
        $pdf = PDF::loadView('admin.pages.booking.invoice', $booking);
        $filename = 'invoice_'. $booking->id .'_' . $booking->transaction_code . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        $vehicles = Vehicle::all();

        return view('admin.pages.booking.edit', [
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
                'origins'    => 'Batur Sari Rental',
                'destinations' => $request->return_loc,
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

        $collection_price = 0;

        if ($request->insurance == 'include'){
            $insurance_price = $rent_price * 25/100;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
        } else{
            $insurance_price = 0;
            $total_price = $rent_price + $insurance_price + $shipping_price + $collection_price;
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
//        dd($request->vehicle_detail_id);
        if ($request->rent_status == 'Selesai' || $request->rent_status == 'Batal' || $request->transaction_status == 'Batal' || $request->return_status == 'Sudah'){
            $vehicleDetail = VehicleDetail::find($request->vehicle_detail_id);
//            dd($vehicleDetail);
            $vehicleDetail->status = "tersedia";
            $vehicleDetail->save();
        }
        $booking->update($data);

        return redirect()->route('bookings.show', $booking->id)->with('status', 'Data Booking berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Booking::findOrFail($id);
        $item->delete();
        DB::table('vehicle_details')
            ->where('id', '=', $item->vehicle_detail_id)
            ->update(['status' => 'tersedia']);

        return redirect()->route('bookings.index')->with('status', 'Data Booking berhasil dihapus!');
    }
}
