<?php

declare(strict_types=1);

use App\Http\Middleware\RequireWorkspace;
use Illuminate\Support\Facades\Route;
use Cornatul\Marketing\Base\Facades\MarketingPortal;

Route::middleware([
    config('sendportal-host.throttle_middleware'),
    RequireWorkspace::class,
    'auth:api',
])->group(function() {

    // Auth'd API routes (workspace-level auth!).
    MarketingPortal::apiRoutes();
});

// Non-auth'd API routes.
MarketingPortal::publicApiRoutes();



