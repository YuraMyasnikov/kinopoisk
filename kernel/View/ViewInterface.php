<?php

namespace App\Kernel\View;

interface ViewInterface
{
    public function page ($name, array $data = []): void;
    public function component ($name): void;
}