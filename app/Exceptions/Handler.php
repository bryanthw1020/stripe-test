<?php

namespace App\Exceptions;

use App\Support\Facades\Responder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $ex)
    {
        if (!$request->expectsJson()) {
            return parent::render($request, $ex);
        }

        if ($ex instanceof AuthenticationException) {
            return Responder::unauthorized();
        } else if ($ex instanceof AuthorizationException) {
            return Responder::forbiddenAction();
        } else if ($ex instanceof ModelNotFoundException) {
            return Responder::notFound();
        } else if ($ex instanceof ValidationException) {
            return Responder::inputError($ex->errors());
        } else {
            return Responder::serverError($ex->getMessage());
        }
    }
}
