<?php
namespace App\Repositories;

use App\Contracts\RepositoryInterface;


class BaseRepository implements RepositoryInterface
{
    public function getAll($model)
    {
        return $model::get();
    }

    public function create($data, $model)
    {
        return $model::create($data);
    }

    public function findById($id, $model)
    {
        return $model::find($id);
    }

    public function update($data, $model)
    {
        $model->update($data);
        return $model->refresh();
    }

    public function delete($model)
    {
        return $model->delete();
    }
}