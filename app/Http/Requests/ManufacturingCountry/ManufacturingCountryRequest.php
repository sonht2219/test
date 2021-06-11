<?php


namespace App\Http\Requests\ManufacturingCountry;


use App\Http\Requests\Base\BaseRequest;

/**
 * Class ManufacturingCountryRequest
 * @package App\Http\Requests\ManufacturingCountry
 *
 * @property-read string $name
 */
class ManufacturingCountryRequest extends BaseRequest
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
