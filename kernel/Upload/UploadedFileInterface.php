<?php

namespace App\Kernel\Upload;

interface UploadedFileInterface
{
    //public function name(): string;
    //public function type(): string;
    //public function size(): int;
    //public function tmpName(): string;
    //public function error(): int;
    //public function isValid(): bool;
    public function move(string $dirName, string $fileName = null): string|false;

    public function getExtension(): string;
}