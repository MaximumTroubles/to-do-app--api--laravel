<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function getAll(): Collection;

    public function taskDone(): Collection;

    public function save(string $name, string $description, string $status): Task;

    public function update(string $name, string $description, string $status, $id): Task;

    public function delete($id): void;
}
