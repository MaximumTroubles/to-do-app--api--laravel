<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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

    public function save(string $name, string $description, string $status): Task
    {
        $task = new Task();
        $task->name = $name;
        $task->description = $description;
        $task->status = $status;
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
