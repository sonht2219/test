<?php


namespace App\Http\Requests\Manufacturer;


use App\Http\Requests\Base\BaseRequest;

/**
 * Class ManufacturerRequest
 * @package App\Http\Requests\Manufacturer
 *
 * @property-read string $name
 */
class ManufacturerRequest extends BaseRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255']
        ];
    }
}
