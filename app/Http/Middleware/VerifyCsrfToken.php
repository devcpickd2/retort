<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Log; // Tambahkan baris ini

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
 // Tambahkan ini di dalam kelas
    public function handle($request, \Closure $next)
    {
        Log::info("Request diterima dari URL: " . $request->fullUrl());
        return parent::handle($request, $next);
    }
}

