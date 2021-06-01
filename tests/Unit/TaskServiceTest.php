<?php

namespace Tests\Unit;

use App\Dto\TaskDto;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

class TaskServiceTest extends TestCase
{
    use CreatesApplication;

    protected TaskServiceInterface $taskService;
    protected TaskRepositoryInterface $taskRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $app = $this->createApplication();
        $app->instance(
            TaskRepositoryInterface::class,
            $this->taskRepository = \Mockery::mock(TaskRepositoryInterface::class)
        );
        $this->taskService = $app->make(TaskServiceInterface::class);
    }

    public function test_get_all_tasks(): void
    {
        $this->taskRepository->shouldReceive('getAll')->once()->andReturn(new Collection());
        $result = $this->taskService->getAll();
        self::assertInstanceOf(Collection::class, $result);
    }

    public function test_get_task_done(): void
    {
        $this->taskRepository->shouldReceive('taskDone')->once()->andReturn(new Collection());
        $result = $this->taskService->taskDone();
        self::assertInstanceOf(Collection::class, $result);
    }

    public function test_that_tasks_creatings(): void
    {
        $dto = new TaskDto('task','desc', 'done');

        $this->taskRepository
            ->shouldReceive('save')
            ->once()
            ->andReturn(
                new Task(
                    [
                        'name' => $dto->getName(),
                        'description' => $dto->getDescription(),
                        'status' => $dto->getStatus(),
                    ]
                )
            );

        $result = $this->taskService->save($dto);

        $this->assertInstanceOf(Task::class, $result);
        $this->assertEquals($dto->getName(), $result->name);
        $this->assertEquals($dto->getDescription(), $result->description);
        $this->assertEquals($dto->getStatus(), $result->status);
    }

    public function test_that_tasks_updatings(): void
    {
        $dto = new TaskDto('task','desc', 'done');

        $this->taskRepository
            ->shouldReceive('update')
            ->once()
            ->andReturn(
                new Task(
                    [
                        'name' => $dto->getName(),
                        'description' => $dto->getDescription(),
                        'status' => $dto->getStatus(),
                    ]
                )
            );

        $id = rand(1, 20); //TODO ASK! how to use variable id num instead of hardcoded!!!
        $result = $this->taskService->update($dto, $id);

        $this->assertInstanceOf(Task::class, $result);
        $this->assertEquals($dto->getName(), $result->name);
        $this->assertEquals($dto->getDescription(), $result->description);
        $this->assertEquals($dto->getStatus(), $result->status);
    }

    public function test_task_deleting(): void
    {
        $this->expectNotToPerformAssertions();
        $id = rand(1, 20); ;
        $this->taskRepository->shouldReceive('delete')->once()->with($id);
        $this->taskService->delete($id);
    }
}
