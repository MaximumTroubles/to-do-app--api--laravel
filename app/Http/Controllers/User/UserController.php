<?php

namespace App\Http\Controllers\User;

use App\Dto\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $userCollection =  $this->userService->getAll();
        return response()->json(
            UserResource::collection($userCollection),
            Response::HTTP_OK);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $dto = new UserDto(
          $request->getName(),
          $request->getPassword(),
        );

        $userNewModel = $this->userService->save($dto);

        return response()->json(
            UserResource::make($userNewModel),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(
            UserResource::make($this->userService->show($id)),
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        $dto = new UserDto(
            $request->getName(),
            $request->getPassword(),
        );

        $updatedUserModel = $this->userService->update($dto, $id);

        return response()->json([
            UserResource::make($updatedUserModel),
            Response::HTTP_OK
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
