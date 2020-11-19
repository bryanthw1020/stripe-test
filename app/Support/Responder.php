<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class Responder
{
    public function success($data = [], $message = '', $code = JsonResponse::HTTP_OK)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function notFound()
    {
        return response()->json([
            'code' => JsonResponse::HTTP_NOT_FOUND,
            'message' => __('responder.no_record'),
        ], JsonResponse::HTTP_NOT_FOUND);
    }

    public function inputError(array $errors)
    {
        return response()->json([
            'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'message' => __('responder.invalid_input'),
            'errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function serverError(string $message)
    {
        return response()->json([
            'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            'message' => App::environment('production') || empty($message) ? __('responder.server_error') : $message,
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function error(string $message, $code = JsonResponse::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ], $code);
    }

    public function unauthorized()
    {
        return $this->error(__('responder.unauthorized'), JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function forbiddenAccess()
    {
        return $this->error(__('responder.no_permission_access'), JsonResponse::HTTP_FORBIDDEN);
    }

    public function forbiddenManage()
    {
        return $this->error(__('responder.no_permission_manage'), JsonResponse::HTTP_FORBIDDEN);
    }

    public function forbiddenAction()
    {
        return $this->error(__('responder.no_permission_perform_action'), JsonResponse::HTTP_FORBIDDEN);
    }

    public function forbiddenLogin()
    {
        return $this->error(__('responder.no_permission_login'), JsonResponse::HTTP_FORBIDDEN);
    }
}
