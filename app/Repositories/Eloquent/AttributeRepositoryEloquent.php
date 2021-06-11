<?php


namespace App\Repositories\Eloquent;


use App\Models\Attribute;
use App\Repositories\Base\RepositoryEloquent;

class AttributeRepositoryEloquent extends RepositoryEloquent
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Attribute::class;
    }
}
