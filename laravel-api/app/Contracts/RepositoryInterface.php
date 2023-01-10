<?php
namespace App\Contracts;

interface RepositoryInterface
{
    public function getAll($model);
    public function create($data, $model);
    public function findById($id, $model);
    public function update($data, $model);
    public function delete($model);
}