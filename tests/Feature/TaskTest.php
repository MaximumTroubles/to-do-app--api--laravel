<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Http\Response;
use Tests\DataBaseTestCase;

class TaskTest extends DataBaseTestCase
{
    public function test_get_all_task(): void
    {
        $result = $this->json('GET', 'api/task');

        $result->assertOk();
        $result->assertJsonStructure([
            [
            'id',
            'name',
            'description',
            'status',
            ]
        ]);
    }

    public function test_get_all_done_task(): void
    {
        $result = $this->json('GET', 'api/task/done');

        $result->assertOk();
        $result->assertJsonStructure([
            [
                'id',
                'name',
                'description',
                'status',
            ]
        ]);
    }

    public function test_task_creating_validation_errors(): void
    {
        $result = $this->json('POST', 'api/task', [
            'name' => '',
            'description' => '',
            'status' => '',
        ]);

        $result->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_that_task_creating(): void
    {
        $result = $this->json('POST', 'api/task', [
            'name' => 'name',
            'description' => 'desc',
            'status' => 'status',
        ]);

        $lastTask = Task::all()->last();
        $unexistedTask = $lastTask->id;

        $result->assertStatus(Response::HTTP_CREATED);
        $result->assertJsonFragment([
                'id' => $unexistedTask,
                'name' => 'name',
                'description' => 'desc',
                'status' => 'status',
        ]);
    }

    public function test_task_updating_validation_errors()
    {
        $task = Task::factory(
            [
                'name' => 'old name',
                'description' => 'olda desc',
                'status' => 'old status',
            ]
        )->create();

        $result = $this->json('PUT', "api/task/$task->id",
            [
                'name' => '',
                'description' => '',
                'status' => '',
            ]
        );
        $result->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_that_task_updating(): void
    {
        $task = Task::factory(
            [
                'name' => 'old name',
                'description' => 'olda desc',
                'status' => 'old status',
            ]
        )->create();

        $name = 'new task';
        $desc = 'new desc';
        $status = 'todo';

        $result = $this->json(
            'PUT', "api/task/$task->id",
            [
                'name' => $name,
                'description' => $desc,
                'status' => $status,
            ]
        );

        $result
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(
                [
                    'id' => $task->id,
                    'name' => $name,
                    'description' => $desc,
                    'status' => $status,
                ]
            );

        $this->assertDatabaseHas('tasks',
            [
                'id' => $task->id,
                'name' => $name,
                'description' => $desc,
                'status' => $status,
            ]
        );
    }

    public function test_that_task_deleting(): void
    {
        $task = Task::factory(
            [
                'name' => 'deletedTask',
                'description' => 'deletedDesc',
                'status' => 'deletedStatus',
            ]
        )->create();

        $result = $this->delete("api/task/$task->id");
        $result->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('tasks',
            [
                'id' => $task->id,
            ]
        );
    }

    public function test_that_task_failed_to_delete(): void
    {
        $lastTask = Task::all()->last();
        $unexistedTask = $lastTask->id + 1;
        $result = $this->delete("api/task/$unexistedTask");
        $result->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
