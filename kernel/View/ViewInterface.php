<?php

namespace App\Kernel\View;

interface ViewInterface
{
    public function page ($name): void;
    public function component ($name): void;
}