<?php


namespace App\Repositories\Base;


use App\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @return Builder
     */
    public function buildQuery(): Builder;
    /**
     * @param string|array $column
     * @param mixed $operator
     * @param mixed $value
     * @return Model|object|static|null
     */
    public function findBy($column, $operator = null, $value = null);

    /**
     * @param $column
     * @param mixed $operator
     * @param mixed $value
     * @return mixed
     * @throws RepositoryException
     */
    public function findByOrFail($column, $operator = null, $value = null);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = []);

    /**
     * @param Model $instance
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $instance, array $attributes = []);

    /**
     * @param $column
     * @param mixed $operator
     * @param mixed $value
     * @return bool
     */
    public function existBy($column, $operator = null, $value = null);
}
