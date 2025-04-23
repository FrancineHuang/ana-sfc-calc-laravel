<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightRequest extends FormRequest
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
            'boarding_date' => 'required|date',
            'departure' => 'required|string|size:3|exists:airports,iata_code',
            'destination' => 'required|string|size:3|exists:airports,iata_code|different:departure',
            'flight_number' => 'required|string|max:10',
            'ticket_price' => 'required|integer|min:0',
            'fare_type' => 'require|string|max:30',
            'other_expenses' => 'nullable|integer|min:0',
            'earned_pp' => 'required|integer|min:0',
            'status' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom error messages for validate errors.
     */

    public function messages() {
        return [
          'boarding_date.required' => '搭乗日は必須です',
          'departure.required' => '出発地は必須です',
          'departure.exists' => '有効な出発地IATAコードを指定してください。',
          'destination.required' => '目的地は必須です。',
          'destination.exists' => '有効な目的地IATAコードを指定してください。',
          'destination.different' => '目的地は出発地と異なる必要があります。',
          'flight_number.required' => '便名は必須です。',
          'ticket_price.required' => '航空券代は必須です。',
          'fare_type.required' => '運賃種類は必須です。',
          'earned_pp.required' => '獲得PPは必須です。',
        ];
    }
}
