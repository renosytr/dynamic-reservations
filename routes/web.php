<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('HomePage', [
        'appName' => config('app.name'),
        'laravelVersion' => Application::VERSION,
    ]);
});