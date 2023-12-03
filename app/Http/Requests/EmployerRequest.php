<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerRequest extends FormRequest
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
            // org details 
            'org_type' => 'string|max:255',
            'street' => 'string|max:255',
            'city' => 'string|max:255',
            'country' => 'string|max:255',
            'establish_year' => 'string|max:255',
            'phone' => 'string|regex:/^\d{3}-\d{3}-\d{4}$/',
            'website'=> 'string|max:255',
            'about' => 'nullable|string',
        ];
    }
}
