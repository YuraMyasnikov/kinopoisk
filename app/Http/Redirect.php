<?php

namespace App\Http;

class Redirect implements RedirectInterface
{
    public function to (string $uri): void
    {
        header( "Location: $uri" );
        exit;
    }
}