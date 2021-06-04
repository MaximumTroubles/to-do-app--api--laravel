<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskException extends Exception
{
    public function taskUpdateStatus(): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => 'Task already Done',
                'status_code' => Response::HTTP_BAD_REQUEST,
            ]
        ], Response::HTTP_BAD_REQUEST);
    }
}
