<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CartPostRequest extends FormRequest
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
            'form.first_name' => ['required'],
            'form.last_name' => ['required'],
            'form.middle_name' => ['required'],
            'form.phone' => ['required'],
            'form.email' => ['required', 'email'],
            'form.region' => ['required'],
            'form.city' => ['required'],
            'form.department' => ['required'],
            'form.address' => ['required'],
            'form.delivery' => ['required'],
            'form.payment' => ['required']
        ];
    }
}
