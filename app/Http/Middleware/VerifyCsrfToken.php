<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/admin',          // Excluding GET request to /admin
        '/admin',          // Excluding POST request to /admin
        '/userPurchases',  // Excluding GET request to /userPurchases
        '/delivered/*',
        '/cart/*',          // Excluding POST request to /cart/{id}
        '/cart',            // Excluding GET request to /cart
        '/remove_cart/*',   // Excluding GET and DELETE requests to /remove_cart/{id}
        '/checkout',        // Excluding GET and POST requests to /checkout
        '/checkoutprod',
        '/admin',                   // Excluding GET request to /admin
        '/editproduct/*',           // Excluding GET request to /editproduct/{id}
        '/editproduct/*',           // Excluding PUT request to /editproduct/{id}
        '/admin/*',
        '/login',               // Excluding GET request to /login
        '/login',               // Excluding POST request to /login
        '/registration',        // Excluding GET request to /registration
        '/registration',        // Excluding POST request to /registration
        '/logout',  


    ];
}
