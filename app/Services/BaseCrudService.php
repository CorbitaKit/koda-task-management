<?php

namespace App\Services;

use App\Interfaces\CRUDInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
abstract class BaseCrudService implements CRUDInterface
{
    public function __construct(protected $repository){}

    public function get(): Collection
    {
        return $this->repository->get();
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(array $data, int $id): Model
    {
        return $this->repository->update($data, $id);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function view(int $id): Model
    {
        return $this->repository->view($id);
    }
}