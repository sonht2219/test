<?php


namespace App\Http\Requests\Base;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

abstract class BaseRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool {
        return !!$this->user();
    }

    /**
     * @return array
     */
    public abstract function rules(): array;

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if (request()->expectsJson()) {
            $response = response()->json(
                [
                    'status' => 0,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()->toArray()
                ]
            );
            throw new HttpResponseException($response);
        }
        parent::failedValidation($validator);
    }
}
