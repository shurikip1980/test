<?php

namespace App\Exceptions;

use App\Http\Services\Api\V1\ResponseService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ResponseService::sendJsonResponse(
                    false,
                    404,
                    ['message' => ['Record not found.']],
                    []
                );
            }
        });

//        $this->renderable(function (\Exception $e, $request) {
//            dd($e);
//        });

        $this->renderable(function (ValidationException  $e, $request) {
            if($request->wantsJson()) {
                return ResponseService::sendJsonResponse(
                    false,
                    $e->status,
                    $e->errors(),
                    []
                );
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if($request->wantsJson()) {
                return ResponseService::notFound();
            }
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            if($request->wantsJson()) {
                return ResponseService::sendJsonResponse(
                    false,
                    401,
                    $e->getMessage(),
                    []
                );
            }
        });
    }
}
