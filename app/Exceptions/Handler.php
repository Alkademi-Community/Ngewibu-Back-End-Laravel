<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

    public function render($request, Throwable $e)
    {

        if($e instanceof NotFoundHttpException && $request->is('api/*'))
        {
            return response()->json([
                'status'  => 'error',
                'code'    => Response::HTTP_NOT_FOUND,
                'message' => 'Page not found.',
                'errors'  => $e->getMessage(),
            ]);
        }

        return parent::render($request, $e);

    }
}
