<?php

namespace App\Http\Controllers\API\V1;

use Throwable;
use App\Exceptions\AppException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

abstract class BaseController extends Controller
{
    public function successResponse(mixed $data, int $statusCode = 200): JsonResponse
    {
        return $this->response(['data' => $data], $statusCode);
    }

    public function errorResponse(mixed $data, int $statusCode = 500): JsonResponse
    {
        return $this->response(['error' => $data], $statusCode);
    }

    public function apiException(Throwable $exception): JsonResponse
    {
        if (!$exception instanceof AppException && !$exception instanceof ValidationException) {
            Log::error('API Error', [
                'error' => $exception->getMessage(),
                'file' => basename($exception->getFile()),
                'line' => $exception->getLine(),
            ]);
        }

        if ($exception instanceof ValidationException) {
            return $this->errorResponse(
                $exception->validator->errors()->all(),
                Response::HTTP_BAD_REQUEST,
            );
        }

        return $this->errorResponse($exception instanceof AppException
            ? $exception->getMessage()
            : 'Internal Server Error'
        );
    }

    private function response(array $data, int $statusCode): JsonResponse
    {
        return response()
            ->json($data, $statusCode);
    }
}
