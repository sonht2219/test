<?php


namespace App\Repositories\Interfaces;


use App\Repositories\Base\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepository extends RepositoryInterface
{
    public function allParentCategory(): Collection;
}
