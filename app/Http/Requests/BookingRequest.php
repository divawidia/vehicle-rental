<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pick_up_loc' => ['required', 'string'],
            'pick_up_datetime' => ['required', 'date', 'after_or_equal:now'],
            'return_datetime' => ['required', 'date','after:pick_up_datetime'],
            'return_loc' => ['required', 'string'],
            'insurance' => ['required', 'in:include,not include'],
            'first_aid_kit' => ['required', 'in:include,not include'],
            'phone_holder' => ['required', 'in:include,not include'],
            'raincoat' => ['required', 'in:include,not include'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'no_hp_wa  ' => ['required', 'phone'],
            'email' => ['required', 'email:rfc,dns'],
            'instagram' => ['required', 'string'],
            'facebook' => ['required', 'string'],
            'country' => ['required', 'string'],
            'home_address' => ['required', 'string'],
            'helmet' => ['required', 'min:1', 'max:2'],
            'transaction_type' => ['required', 'in:COD,Transfer'],
            'shipping_status' => ['in:Sudah,Belum'],
            'return_status' => ['in:Sudah,Belum'],
            'transaction_status' => ['in:Sudah Dibayar,Belum Dibayar,Batal'],
            'rent_status' => ['in:Selesai,Dibooking,Disewa,Batal'],
            'insurance_price' => ['required', 'numeric'],
            'shipping_price' => ['required', 'numeric'],
            'booking_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'total_fine' => ['numeric'],
            'vehicle_license_plate' => ['string'],
            'total_days_rent' => ['required', 'numeric'],
            'month_rent' => ['required', 'numeric'],
            'latitude_pickup' => ['required', 'decimal:8'],
            'longitude_pickup' => ['required', 'decimal:8'],
            'latitude_return' => ['required', 'decimal:8'],
            'longitude_return' => ['required', 'decimal:8'],
            'collection_price' => ['numeric'],
            'distance_pickup' => ['required', 'decimal:2'],
            'rounded_distance_pickup' => ['required', 'decimal:2'],
            'distance_return' => ['required', 'decimal:2'],
            'rounded_distance_return' => ['required', 'decimal:2'],
            'weekly_rent_price' => ['numeric'],
            'vehicle_id' => ['required', 'exists:vehicles,id']
        ];
    }
}
