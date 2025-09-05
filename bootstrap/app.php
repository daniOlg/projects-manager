<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'message' => 'Method not allowed',
            ], 405);
        });

        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        });

        $exceptions->render(function (AccessDeniedHttpException $e, $request) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        });

        $exceptions->render(function (UnauthorizedHttpException $e, $request) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        });

        $exceptions->render(function (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        });
    })
    ->create();
