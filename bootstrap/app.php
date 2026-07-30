<?php

use App\Http\Middleware\AddSecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Two independent auth guards share this app: 'web' for internal staff
        // (admin panel) and 'candidate' for job applicants (/careers/*). Route
        // guests/authenticated-redirects to the right login/home per guard.
        $middleware->redirectGuestsTo(fn ($request) => $request->is('careers/*')
            ? route('candidate.login')
            : route('login'));

        $middleware->redirectUsersTo(fn ($request) => $request->is('careers/*')
            ? route('candidate.applications.index')
            : route('dashboard'));

        $middleware->append(AddSecurityHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
