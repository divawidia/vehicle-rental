<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_name' => ['required', 'max:255', Rule::unique('vehicles', 'vehicle_name')->ignore($this->kendaraan)],
            'description' => ['required', 'string'],
//            'slug' => ['required', 'string'],
            'thumbnail' => ['image'],
            'body' => ['required', 'string'],
            'passenger' => ['required'],
            'fuel_capacity' => ['required'],
            'fuel_type' => ['required', 'string'],
            'engine_capacity' => ['required'],
            'fuel_economy' => ['required'],
            'year' => ['required'],
            'color' => ['required', 'string'],
            'daily_price' => ['required'],
            'monthly_price' => ['required'],
            'unit_quantity' => ['required'],
            'vehicle_type_id' => ['required', 'exists:vehicle_types,id'],
            'brand_id' => ['required', 'exists:vehicle_brands,id'],
            'transmission_id' => ['required', 'exists:transmissions,id']
        ];
    }
}
