<?php
/**
 * Exception handler
 *
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */
namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
       // Retruning JSON response, file not found exception occurs
        if ($exception instanceof  \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->json(['message' => 'Not Found!'], 404);
        }
        return parent::render($request, $exception);
    }
}
