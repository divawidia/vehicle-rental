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
            'vehicle_name' => ['required', 'max:255', Rule::unique('vehicles', 'vehicle_name')->ignore($this->vehicle)],
            'description' => ['required'],
            'thumbnail' => ['required', 'image'],
            'features' => ['required'],
            'body' => ['required'],
            'passenger' => ['required', 'numeric'],
            'fuel_capacity' => ['required', 'numeric'],
            'fuel_type' => ['required', 'string'],
            'engine_capacity' => ['required', 'numeric'],
            'fuel_economy' => ['required', 'numeric'],
            'year' => ['required', 'digits_between:2010,2024'],
            'color' => ['required', 'string'],
            'daily_price' => ['required', 'numeric'],
            'weekly_price' => ['numeric'],
            'monthly_price' => ['required', 'numeric'],
            'unit_quantity' => ['required', 'numeric'],
            'vehicle_type_id' => ['required', 'exists:vehicle_types,id'],
            'brand_id' => ['required', 'exists:vehicle_brands,id'],
            'transmission_id' => ['required', 'exists:transmissions,id'],
        ];
    }
}
