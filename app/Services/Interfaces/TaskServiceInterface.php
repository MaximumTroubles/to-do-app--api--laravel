<?php

namespace App\Services\Interfaces;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    public function getAll(): Collection;

    public function taskDone(): Collection;

    public function save(TaskRequest $request): Task;

    public function update(UpdateTaskRequest $request, $id): Task;

    public function delete($id): void;
}
