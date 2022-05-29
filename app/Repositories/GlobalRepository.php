<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class GlobalRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function update($data)
    {
        return $this->model->update($data);
    }

    public function delete($id)
    {
        $delete = $this->model->find($id);
        if(! $delete){
            return false;
        }
        return $delete->delete();
    }
}
