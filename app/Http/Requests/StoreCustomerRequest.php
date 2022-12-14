<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'dni' => ['required'],
            'id_reg' => ['required'],
            'id_com'  => ['required'],
            'email' => ['required', 'max:120'],
            'name' => ['required', 'max:45'],
            'last_name' => ['required', 'max:45'],
            'address' => ['max:255'],
            'date_reg' => ['required'],
        ];
    }
}
