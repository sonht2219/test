<?php


namespace App\Http\Requests\Attribute;


use App\Http\Requests\Base\BaseRequest;

class AttributeRequest extends BaseRequest
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
