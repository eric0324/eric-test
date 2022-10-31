<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{

    protected $model;

    /**
     * Create a new instance of the given model.
     *
     * @param  array $attributes
     *
     * @return static
     */
    public function newInstance($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }


    /**
     * @param $columns
     * @return Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * @param $attributes
     * @return Model
     */
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update($id, array $attributes, array $options = [])
    {
        $instance = $this->model->findOrFail($id);

        return $instance->update($attributes, $options);
    }

    /**
     * @param $column
     * @param $value
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function updateBy($column, $value, array $attributes = [], array $options = [])
    {
        return $this->model
            ->where($column, $value)
            ->update($attributes, $options);
    }

    /**
     * @param array $columns
     * @param array $with
     * @return mixed
     */
    public function first($columns = ['*'], $with = [])
    {
        return $this->model->first($columns);
    }

    /**
     * @param $column
     * @param $value
     * @param array $columns
     * @param array $with
     * @return mixed
     */
    public function firstBy($column, $value, $columns = ['*'], $with = [])
    {
        return $this->model
            ->with($with)
            ->where($column, $value)
            ->first($columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @param array $with
     * @return Collection|Model
     */
    public function find($id, $columns = ['*'], $with = [])
    {
        return $this->model
            ->with($with)
            ->find($id, $columns);
    }

    /**
     * @param $column
     * @param $value
     * @param array $columns
     * @param array $with
     * @return mixed
     */
    public function findBy($column, $value, $columns = ['*'], $with = [])
    {
        return $this->model
            ->where($column, $value)
            ->with($with)
            ->first($columns);
    }

    /**
     * @param array $columns
     * @param array $with
     * @return Collection|static[]
     */
    public function get($columns = ['*'], $with = [])
    {
        return $this->model
            ->with($with)
            ->get($columns);
    }

    /**
     * @param array $columns
     * @param array $with
     * @return Collection|static[]
     */
    public function take($columns = ['*'], $with = [])
    {
        return $this->model
            ->with($with)
            ->get($columns);
    }

    /**
     * @param $column
     * @param $value
     * @param array $columns
     * @return Collection|static[]
     */
    public function getBy($column, $value, $columns = ['*'], $with = [])
    {
        return $this->model
            ->where($column, $value)
            ->with($with)
            ->get($columns);
    }

    /**
     * @param $ids
     * @return int
     * @internal param $id
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * @param $column
     * @param $value
     * @return bool|null
     */
    public function destroyBy($column, $value)
    {
        return $this->model
            ->where($column, $value)
            ->delete();
    }

    /**
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null, $with = [])
    {
        return $this->model
            ->with($with)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param $column
     * @param $value
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @param array $with
     * @return LengthAwarePaginator
     */
    public function paginateBy($column, $value, $perPage = null, $columns = ['*'], $pageName = 'page', $page = null, $with = [])
    {
        return $this->model
            ->with($with)
            ->where($column, $value)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param $column
     * @param $value
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @param array $with
     * @return LengthAwarePaginator
     */
    public function paginateAscBy($column, $value, $perPage = null, $columns = ['*'], $pageName = 'page', $page = null, $with = [])
    {
        return $this->model
            ->with($with)
            ->where($column, $value)
            ->paginate($perPage, $columns, $pageName, $page);
    }
}
