<?php

namespace App\Services;

use App\Dto\TaskDto;
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

    public function save(TaskDto $dto): Task
    {
        return $this->taskRepository->save(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getStatus()
        );
    }

    public function update(TaskDto $dto, $id): Task
    {
        return $this->taskRepository->update(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getStatus(),
            $id);
    }

    public function delete($id): void
    {
        $this->taskRepository->delete($id);
    }
}
