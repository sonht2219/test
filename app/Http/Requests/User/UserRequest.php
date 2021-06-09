<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rules\Password;

/**
 * Class UserRequest
 * @package App\Http\Requests
 * @property-read string $email
 * @property-read string $name
 * @property-read string $phone_number
 * @property-read string $password
 * @property-read string $avatar
 * @property-read Date $dob
 * @property-read string $address
 */
class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:10', 'unique:users,phone_number'],
            'password' => ['required', 'confirmed', Password::min(6)->letters()],
            'avatar' => ['nullable', 'string'],
            'dob' => ['nullable', 'date:Y-m-d'],
            'address' => ['nullable', 'string']
        ];
        if ($this->method() == "PUT") {
            $rules['email'] = ['nullable', 'email', 'max:255'];
            $rules['password'] = ['nullable'];

        }
        return $rules;
    }
}
