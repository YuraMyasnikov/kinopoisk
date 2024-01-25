<?php

namespace App\Http;

interface RedirectInterface
{
    public function to (string $uri): void;
}