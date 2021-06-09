<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll(): Collection
    {
        return Task::all();
    }

    public function taskDone(): Collection
    {
        return Task::all()->where('status', 'done');
    }

    public function save(string $name, string $description, string $status, int $user_id): Task
    {
        $task = new Task();
        $task->name = $name;
        $task->description = $description;
        $task->status = $status;
        $task->user_id = $user_id;
        $task->save();

        return $task;
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $status
     * @param $id
     * @return Task
     */

    public function checkTaskStatus($id): Task
    {
        return Task::findOrFail($id);
    }

    public function update(string $name, string $description, string $status, $id): Task
    {
        /** @var Task $task */
        $task = Task::query()->findOrFail($id);
        $task->update(
            [
                $task->name = $name,
                $task->description = $description,
                $task->status = $status
            ]
        );

        return $task;
    }

    public function delete($id): void
    {
        $deletedTask = Task::query()->findOrFail($id);
        $deletedTask->delete();
    }
}
