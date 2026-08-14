<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
{
    if ($request->is('api/*')) {

        if ($exception instanceof ModelNotFoundException) {

            return response()->json([
                'success' => false,
                'message' => 'This Student not found.'
            ], 404);

        }

        if ($exception instanceof ValidationException) {

            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'errors' => $exception->errors()
            ], 422);

        }

        if ($exception instanceof AuthenticationException) {

            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.'
            ], 401);

        }

    }

    return parent::render($request, $exception);
}

}
