<?php

namespace App\Kernel\Validator;

interface ValadatorInterface
{
    public function validate(array $data, array $rules): bool;
    public function errors(): array;

}