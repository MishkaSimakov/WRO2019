<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://digcity.000webhostapp.com/posts/create',
        'http://digcity.000webhostapp.com/currents/create',
        'http://digcity.000webhostapp.com/channels/create',
        'http://digcity.000webhostapp.com/statuses/create',
        'http://digcity.000webhostapp.com/sensors/create',
        'http://digcity.000webhostapp.com/upload',
    ];
}