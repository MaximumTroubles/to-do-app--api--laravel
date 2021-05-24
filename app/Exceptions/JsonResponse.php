<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

trait JsonResponse
{
    public function getModelJsonValidationResponceException()
    {
        return response()->json([
            'data' => [
                'message' => 'Model not found',
                'status code' => Response::HTTP_NOT_FOUND
            ]
        ],Response::HTTP_NOT_FOUND);
    }
}
