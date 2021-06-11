<?php


namespace App\Repositories\Eloquent;


use App\Models\Unit;
use App\Repositories\Base\RepositoryEloquent;

class UnitRepositoryEloquent extends RepositoryEloquent
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Unit::class;
    }
}
