<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait JsonResponseTrait
{
    public function getModelJsonResponceException(): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => 'Model not found',
                'status code' => Response::HTTP_NOT_FOUND
            ]
        ],Response::HTTP_NOT_FOUND);
    }

    public function getHttpJsonResponceExeption(): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => 'Endpoint not found',
                'status_code' => Response::HTTP_NOT_FOUND,
            ]
        ], Response::HTTP_NOT_FOUND);
    }

    public function getValidationJsonResponceExeption(ValidationException $e): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => $e->errors(),
                'status_code' => $e->status,
            ]
        ], $e->status);
    }

    public function getBadRequestJsonResponceExeption($e): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => $e->getMessage(),
                'status_code' => Response::HTTP_BAD_REQUEST,
            ]
        ], Response::HTTP_BAD_REQUEST);
    }

}
