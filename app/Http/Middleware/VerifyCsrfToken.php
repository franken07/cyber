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
        '/admin',                   // Excluding GET and POST requests to /admin
        '/userPurchases',           // Excluding GET request to /userPurchases
        '/delivered/*',             // Excluding GET and POST requests to /delivered/{id}
        '/cart/*',                  // Excluding POST request to /cart/{id}
        '/cart',                    // Excluding GET request to /cart
        '/remove_cart/*',           // Excluding GET and DELETE requests to /remove_cart/{id}
        '/checkout',                // Excluding GET and POST requests to /checkout
        '/checkoutprod',            // Excluding GET and POST requests to /checkoutprod
        '/admin/*',                 // Excluding all routes under /admin
        '/editproduct/*',           // Excluding GET and PUT requests to /editproduct/{id}
        '/login',                   // Excluding GET and POST requests to /login
        '/registration',            // Excluding GET and POST requests to /registration
        '/logout',                  // Excluding GET request to /logout
        'users/*/update-usertype',  // Excluding PUT request to /users/{id}/update-usertype
        '/components',
    ];
}
