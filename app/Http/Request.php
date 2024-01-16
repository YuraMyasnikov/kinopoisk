<?php

namespace App\Http;

class Request // Запрашивает (строка браузера)
{
    public readonly array $get;
    public readonly array $post;
    public readonly array $server;
    public readonly array $files;
    public readonly array $cookie;

    /**
     * @param array $get
     * @param array $post
     * @param array $server
     * @param array $files
     * @param array $cookie
     */
    public function __construct(array $get, array $post, array $server, array $files, array $cookie)
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



}