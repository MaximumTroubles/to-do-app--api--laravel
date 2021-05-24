<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAll(): Collection
    {
        return $this->taskRepository->getAll();
    }

    public function taskDone(): Collection
    {
        return $this->taskRepository->taskDone();
    }

    public function save(TaskRequest $request) : Task
    {
        return $this->taskRepository->save($request);
    }

    public function update(UpdateTaskRequest $request, $id): Task
    {
        return $this->taskRepository->update($request, $id);
    }

    public function delete($id): void
    {
        $this->taskRepository->delete($id);
    }
}
