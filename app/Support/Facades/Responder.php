<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\JsonResponse success(array $data, string $message, int $code = 200)
 * @method static \Illuminate\Http\JsonResponse error(string $message, int $code = 400)
 * @method static \Illuminate\Http\JsonResponse inputError(array $errors)
 * @method static \Illuminate\Http\JsonResponse serverError(string $message)
 * @method static \Illuminate\Http\JsonResponse notFound()
 * @method static \Illuminate\Http\JsonResponse unauthorized()
 * @method static \Illuminate\Http\JsonResponse forbiddenAccess()
 * @method static \Illuminate\Http\JsonResponse forbiddenManage()
 * @method static \Illuminate\Http\JsonResponse forbiddenAction()
 * @method static \Illuminate\Http\JsonResponse forbiddenLogin()
 *
 * @see \App\Support\Responder
 */
class Responder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'responder';
    }
}
