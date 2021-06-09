<?php

namespace App\Http\Controllers\Task;

use App\Dto\TaskDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    private TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index(): JsonResponse
    {
        $tasksDone = $this->taskService->getAll();

        return response()
            ->json(
                TaskResource::collection($tasksDone),
                Response::HTTP_OK
            );
    }

    public function taskDone(): JsonResponse
    {
        $taskDone = $this->taskService->taskDone();

        return response()
            ->json(
              TaskResource::collection($taskDone),
              Response::HTTP_OK
            );
    }

    /**
     * Store a newly created resource in storage.
     *->
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $dto = new TaskDto(
            $request->getName(),
            $request->getDescription(),
            $request->getStatus(),
            $request->getUserId(),
        );
        $storedTask = $this->taskService->save($dto);

        return response()
            ->json(
                TaskResource::make($storedTask),
                Response::HTTP_CREATED
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        $dto = new TaskDto(
            $request->getName(),
            $request->getDescription(),
            $request->getStatus(),
            $request->getUserId(),
        );
        $updated = $this->taskService->update($dto, $id);

        return response()
            ->json(
                TaskResource::make($updated),
                Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->taskService->delete($id);
        return response()
            ->json(null, Response::HTTP_NO_CONTENT);

    }
}
