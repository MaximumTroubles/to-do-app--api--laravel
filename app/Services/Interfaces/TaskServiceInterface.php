<?php

namespace App\Services\Interfaces;

use App\Dto\TaskDto;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    public function getAll(): Collection;

    public function taskDone(): Collection;

    public function save(TaskDto $dto): Task;

    public function update(TaskDto $dto, $id): Task;

    public function delete($id): void;
}
