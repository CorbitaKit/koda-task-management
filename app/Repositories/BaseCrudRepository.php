<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
abstract class BaseCrudRepository implements CRUDInterface
{
    public function __construct(private Model $model)
    {}
    public function get(): Collection
    {
        return $this->model->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): Model
    {
        $modelObj = $this->model->findOrFail($id);
        $modelObj->update($data);
        return $modelObj;
    }

    public function delete(int $id): bool
    {
        $modelObj = $this->model->findOrFail($id);
        
        return $modelObj->delete();
    }

    public function view(int $id): Model
    {
        return $this->model->where('id', $id)->firstOrFail();
    }
}