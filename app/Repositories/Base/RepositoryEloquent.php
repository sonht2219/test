<?php


namespace App\Repositories\Base;


use App\Exceptions\RepositoryException;
use App\Models\User;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Concerns\BuildsQueries;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Exception;

abstract class RepositoryEloquent implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Application
     */
    protected Application $app;

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    /**
     * RepositoryEloquent constructor.
     * @param Application $app
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return Model|object
     * @throws RepositoryException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    /**
     * @return Builder
     */
    public function buildQuery(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @param array|string $column
     * @param mixed $operator
     * @param mixed $value
     * @return Model|object|null
     */
    public function findBy($column, $operator = null, $value = null)
    {
        return $this->model->firstWhere($column, $operator, $value);
    }

    /**
     * @param $column
     * @param mixed $operator
     * @param mixed $value
     * @return Model|mixed|object|null
     * @throws RepositoryException
     */
    public function findByOrFail($column, $operator = null, $value = null)
    {
        if (!$model = $this->findBy($column, $operator = null, $value = null))
            throw new RepositoryException("Not Exist Instance {$this->model()}");

        return $model;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = [])
    {
        return tap($this->model->create($attributes), fn(Model $instance) => $instance->refresh());
    }

    /**
     * @param Model $instance
     * @param array $attributes
     * @return mixed|void
     * @throws RepositoryException
     */
    public function update(Model $instance, array $attributes = [])
    {
        if (!$instance->update($attributes))
            throw new RepositoryException('Update fail');
        return $instance;
    }

    /**
     * @param $column
     * @param mixed $operator
     * @param mixed $value
     * @return bool
     */
    public function existBy($column, $operator = null, $value = null)
    {
        return $this->model->where($column, $operator = null, $value = null)->exists();
    }
}
