<?php

namespace App\Http;

use App\Kernel\Storage\Storage;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\Upload\UploadedFile;
use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValadatorInterface;
use App\Kernel\Validator\Validator;

class Request implements RequestInterface// Запрашивает (строка браузера)
{
    public readonly array $get;
    public readonly array $post;
    public readonly array $server;
    public readonly array $files;
    public readonly array $cookie;

    private ValadatorInterface $validator;

    /**
     * @param array $get
     * @param array $post
     * @param array $server
     * @param array $files
     * @param array $cookie
     */
    public function __construct(array $get, array $post, array $server, array $files, array $cookie,)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->files = $files;
        $this->cookie = $cookie;
    }

    static public function findGlobal(): static // возвращает глобальные массивы
    {
        return new static($_GET,$_POST,$_SERVER,$_FILES,$_COOKIE);
    }

    //получения get-запроса без параметров
    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'],'?'); // отрезает у строки все начиная с "?"
    }
    //получение метода входа на страницу
    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function input(string $key, $default = null): mixed //
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function validate(array $rules): bool //['name_movie' => ['require', 'min:3', 'max:10']]
    {
        $data = [];

        foreach ($rules as $key => $rule) // as 'name_movie' => ['require', 'min:3', 'max:10']
        {
                $data[$key] = $this->input($key);
        }
        return $this->validator->validate($data, $rules);
    }

    public function file(string $key): ?UploadedFileInterface
    {
        if (! isset($this->files[$key]) )
        {
            return null;
        }

        return new UploadedFile(
            $this->files[$key]['name'],
            $this->files[$key]['type'],
            $this->files[$key]['size'],
            $this->files[$key]['error'],
            $this->files[$key]['tmp_name'],
        );
    }

    public function storage(): StorageInterface
    {
        return new Storage('http://kinopoisk');
    }

    public function setValidator(ValadatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function errors(): array
    {
        return $this->validator->errors();
    }

}