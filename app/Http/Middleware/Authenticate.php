<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $front = config('app.front_url');
        \Log::info($front);
        return redirect()->to('https://www.google.com');
        if (! $request->expectsJson()) {
            return redirect()->to($front . '/login');
        }
    }
}
