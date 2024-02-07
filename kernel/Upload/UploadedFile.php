<?php

namespace App\Kernel\Upload;

use App\Kernel\Upload\UploadedFileInterface;

class UploadedFile implements UploadedFileInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $size,
        public readonly int $error,
        public readonly string $tmpName,
        /*public readonly bool $isValid,*/
    )
    {    }

    public function move(string $dirName, string $fileName = null): string|false
    {
        $storagePath = MAIN_PATH . "/storage/$dirName"; //путь до места где будет храниться

        if( !is_dir($storagePath) )
        {
            mkdir($storagePath, "0777", true); //создать файл если его нет
        }

        $fileName = $fileName ?? $this->randomFileName(); // если не передан имя файла сделать уникальный рандом

        $filePath = "$storagePath/$fileName"; // файл в дериктории с названием или рандомное название


        if (move_uploaded_file($this->tmpName, $filePath)) //откуда и до хранении сущности
        {
            return "$dirName/$fileName";
        };

        return false;
    }

    private function randomFileName(): string //уникальный рандомный хеш с добавлением расширения
    {
        return md5(uniqid(rand(),true)) .'.'. $this->getExtension();
    }

    public function getExtension(): string //берет название расширения
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }


}