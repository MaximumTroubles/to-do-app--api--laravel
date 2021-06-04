<?php

namespace App\Services;

use App\Dto\TaskDto;
use App\Exceptions\TaskException;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Support\Collection;

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
        $taskDoneCollection = $this->taskRepository->taskDone();
            if ( $taskDoneCollection->count() >= 1 ){
                var_dump($taskDoneCollection->count());
                return $taskDoneCollection;
            }

        return $taskDoneCollection;
    }

    public function save(TaskDto $dto): Task
    {
        // automatically set status = todo

        return $this->taskRepository->save(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getStatus()
        );
    }

    /**
     * @throws TaskException
     */
    public function update(TaskDto $dto, $id): Task
    {
        /**
         * task statuses: done, in_progress, todo
         *
         *  if task status === done - task can not be updated. Throw exception
         */

        // find task by id
        // check task status
        // if task status === done - task can not be updated -> Throw exception
        // update task

        $checkTaskStatus = $this->taskRepository->checkTaskStatus($id);
        if ($checkTaskStatus->status === 'done'){
            throw new TaskException();
        }
        return $this->taskRepository->update(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getStatus(),
            $id
        );
    }

    public function delete($id): void
    {
        // only task with status "done" can be deleted
        $task = $this->taskRepository->checkTaskStatus($id);
        if ($task->status == 'done'){
            return;
        } else {
            $this->taskRepository->delete($id);
        }
    }
}
