<?php

namespace App\Http\Traits;

use Throwable;
use App\Exceptions\AppException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponseTrait
{
    public function successResponse(mixed $data, int $statusCode = 200): JsonResponse
    {
        return $this->response(['data' => $data], $statusCode);
    }

    public function errorResponse(mixed $data, int $statusCode = 500): JsonResponse
    {
        return $this->response(['error' => $data], $statusCode);
    }

    public function jsonException(string $errorReason, Throwable $exception): JsonResponse
    {
        if (!$exception instanceof AppException && !$exception instanceof ValidationException) {
            Log::error($errorReason, [
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
            : $errorReason
        );
    }

    private function response(array $data, int $statusCode): JsonResponse
    {
        return response()
            ->json($data, $statusCode);
    }
}
