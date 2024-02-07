<?php

namespace App\Movies;

use App\Kernel\DataBase\DataBaseInterface;
use App\Kernel\Storage\Storage;
use App\Kernel\Storage\StorageInterface;

class Movies
{
    public function __construct(
        protected DataBaseInterface $db,
        protected StorageInterface $storage
    ) {
    }

    public function getList(int $count = 10)
    {
        $list = $this->db->list('movies');
        foreach ($list as &$movie)
        {
            if($movie['image']) {
                $movie['image'] = $this->storage->url($movie['image']);
            }
        }

        return $list;
    }
}