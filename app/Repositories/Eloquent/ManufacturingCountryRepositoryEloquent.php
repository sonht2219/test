<?php


namespace App\Repositories\Eloquent;


use App\Models\ManufacturingCountry;
use App\Repositories\Base\RepositoryEloquent;
use App\Repositories\Interfaces\ManufacturingCountryRepository;

class ManufacturingCountryRepositoryEloquent extends RepositoryEloquent implements ManufacturingCountryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ManufacturingCountry::class;
    }
}
