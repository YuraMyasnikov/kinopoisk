<?php

namespace App\Http;

class Redirect
{
    public function to (string $uri): void
    {
        header( "Location: $uri" );
        exit;
    }
}