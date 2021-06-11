<?php


namespace App\Repositories\Eloquent;


use App\Models\Manufacturer;
use App\Repositories\Base\RepositoryEloquent;
use App\Repositories\Interfaces\ManufacturerRepository;

class ManufacturerRepositoryEloquent extends RepositoryEloquent implements ManufacturerRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Manufacturer::class;
    }
}
