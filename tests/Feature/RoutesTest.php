<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * This test iterates the application's GET/HEAD routes (no parameters)
 * and asserts they do not return a server error (5xx). It ignores
 * debug/vendor/admin routes and closures. It's intentionally conservative
 * to avoid calling parameterized or state-changing routes.
 */

it('does not return 5xx for public GET routes', function () {
    $routes = collect(Route::getRoutes())->filter(function ($route) {
        $methods = $route->methods();

        // Only GET/HEAD routes (safe to call)
        if (! in_array('GET', $methods) && ! in_array('HEAD', $methods)) {
            return false;
        }

        $uri = (string) $route->uri();

        // Skip parameterized routes like users/{user}
        if (Str::contains($uri, '{')) {
            return false;
        }

        // Skip closures (they may require specific runtime context)
        if (Str::contains($route->getActionName(), 'Closure')) {
            return false;
        }

        // Skip common vendor/admin/debug routes
        $skipPrefixes = [
            '_debugbar',
            'horizon',
            'telescope',
            'ignition',
            'nova',
            'vendor',
            'sanctum',
        ];

        foreach ($skipPrefixes as $p) {
            if (Str::startsWith($uri, $p) || Str::contains($uri, "{$p}/")) {
                return false;
            }
        }

        return true;
    });

    // Ensure we actually have routes to test
    expect($routes->count())->toBeGreaterThan(0);

    // Fake Mail to avoid sending real emails or driver issues during route smoke tests
    Mail::fake();

    // Routes to skip from this generic smoke test (require special context)
    $skipUris = [
        '/send-mail',
    ];

    foreach ($routes as $route) {
        $uri = '/' . ltrim($route->uri(), '/');

        if (in_array($uri, $skipUris, true)) {
            // Skip routes that require special setup or trigger side effects
            continue;
        }

        $response = $this->get($uri);
        $status = $response->getStatusCode();

        // If server error, include response content for debugging
        if ($status >= 500) {
            $content = $response->getContent();
            test()->fail("Route [{$uri}] returned server error status {$status}. Response content:\n{$content}");
        }
        // Otherwise assert success (no 5xx)
        test()->assertTrue($status < 500, "Route [{$uri}] returned server error status {$status}");
    }
});
