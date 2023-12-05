<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Employer;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['string', 'max:255'], 
            'email' => ['email', 'max:255'],
        ];
    }

    public function employer()
    {
        // Employer record.
        return Employer::where('organization_name', $this->username)->first();
    }
}
