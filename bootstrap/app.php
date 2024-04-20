<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {

            if($request->is('api/client/*')) {
                return true;
            }

            if($request->is('api/budget/*')) {
                return true;
            }

            if($request->is('api/project/*')) {
                return true;
            }

            return response()->json([
                'status' => false,
                'message' => 'The selected id was not found',
            ], 500);

        });
    })->create();
