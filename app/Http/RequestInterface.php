<?php

namespace App\Http;

use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValadatorInterface;

interface RequestInterface
{
    static public function findGlobal(): static; // возвращает глобальные массивы
    public function uri(): string;
    public function method(): string;
    public function input(string $key, $default = null): mixed;
    public function validate(array $rules): bool; //['name_movie' => ['require', 'min:3', 'max:10']]
    public function setValidator(ValadatorInterface $validator): void;
    public function errors(): array;
    public function file(string $key): ?UploadedFileInterface;
}