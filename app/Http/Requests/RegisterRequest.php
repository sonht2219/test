<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Validation\Rules\Password;

/**
 * Class RegisterRequest
 * @package App\Http\Requests
 * @property-read string $email
 * @property-read string $name
 * @property-read string $phone_number
 * @property-read string $password
 */
class RegisterRequest extends BaseRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:10', 'unique:users,phone_number'],
            'password' => ['required', 'confirmed', Password::min(6)->letters()],
        ];
    }
}
