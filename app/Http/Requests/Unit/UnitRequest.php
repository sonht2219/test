<?php


namespace App\Http\Requests\Unit;


use App\Http\Requests\Base\BaseRequest;

class UnitRequest extends BaseRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255']
        ];
    }
}
