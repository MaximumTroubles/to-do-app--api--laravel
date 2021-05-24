<?php

namespace App\Repositories;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll(): Collection
    {
        return  Task::all();
    }

    public function taskDone(): Collection
    {
        return Task::all()->where('status', 'done');
    }

    public function save(TaskRequest $request): Task
    {
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->save();
        return $task;
    }

    public function update(UpdateTaskRequest $request, $id): Task
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return $task;
    }

    public function delete($id): void
    {
        $deletedTask = Task::findOrFail($id);
        $deletedTask->delete();
    }
}
