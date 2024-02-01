<?php

namespace App\Kernel\Miidleware;

use App\Http\RedirectInterface;
use App\Http\RequestInterface;
use App\Kernel\Auth\AuthInterface;

abstract class AbstractMiddleware
{
    public function __construct(
        protected RequestInterface $request,
        protected AuthInterface $auth,
        protected RedirectInterface $redirect,
    )
    {
    }

    abstract public function handle (): void;                                                                                        // en handle | ru управлять справляться

}