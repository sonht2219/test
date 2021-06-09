<?php


namespace App\Repositories\Eloquent;


use App\Models\Test;
use App\Repositories\Base\RepositoryEloquent;

class TestRepositoryEloquent extends RepositoryEloquent
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Test::class;
    }
}
