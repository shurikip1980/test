<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'form.id' => ['required'],
            'form.first_name' => ['required', 'string', 'max:255'],
            'form.last_name' => ['required', 'string', 'max:255'],
            'form.middle_name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'form.phone' => ['required', 'string', 'max:255'],
        ];
    }
}

