<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\VehicleDetail;
use App\Models\VehicleType;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class VehiclePageBookingController extends Controller
{
    public function postUserPageBooking1(Request $request, string $slug){

        $validatedData = $request->validate([
            'vehicle_id' => 'required',
            'pick_up_loc' => 'required',
            'return_loc' => 'required',
            'pick_up_datetime' => 'required',
            'return_datetime' => 'required',
            'latitude_pickup' => 'required',
            'longitude_pickup' => 'required',
            'latitude_return' => 'required',
            'longitude_return' => 'required',
        ]);

        $request->session()->put('booking', $validatedData);
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        return redirect()->route('choose-features', $vehicle->slug);
    }

    public function userPageBooking2(Request $request,string $slug){
        $booking = $request->session()->get('booking');
        $vehicle = Vehicle::findOrFail($booking['vehicle_id']);

        return view('pages.choose-features', compact('booking', 'vehicle'));
    }

    public function postUserPageBooking2(Request $request,string $slug){

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
        $vehicle = Vehicle::where('id', $booking['vehicle_id'])->first();
//        dd($vehicle->monthly_price);

        $month_rent = 0;
        $monthly_rent_price = 0;
        $week_rent = 0;
        $weekly_rent_price = 0;

        if ($total_days_rent >= 30){
            $month_rent = floor($total_days_rent/30);
            $monthly_rent_price = $vehicle->monthly_price * $month_rent;

            $days_rent = $total_days_rent-($month_rent*30);
            $daily_rent_price = $vehicle->daily_price * $days_rent;

            $rent_price = $monthly_rent_price + $daily_rent_price;
        } else {
            $days_rent = $total_days_rent;
            $daily_rent_price = $vehicle->daily_price * $days_rent;

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

        $vehicleDetail = VehicleDetail::where('vehicle_id', '=', $vehicle->id)->where('status', '=', 'tersedia')->first();
//        dd($vehicle->slug);
        $data['vehicle_detail_id'] = $vehicleDetail->id;
        $data['vehicle_id'] = $vehicle->id;


        $newBooking = new Booking();

        $newBooking->fill($data);
        $request->session()->put('booking', $newBooking);

        return redirect()->route('vehicle-booking-payment', $vehicle->slug);
    }

    public function userPageBooking3(Request $request, string $slug){
        $booking = $request->session()->get('booking');
//        dd($booking);

        return view('pages.payment', compact('booking'));
    }

    public function postUserPageBooking3(Request $request, string $slug){
        $data = $request->all();
        $booking = $request->session()->get('booking');

        if ($request->transaction_type == 'COD') {
            $booking->fill($data);
            $booking->save();

            DB::table('vehicle_details')
                ->where('id', '=', $booking['vehicle_detail_id'])
                ->update(['status' => 'disewa']);

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
}
