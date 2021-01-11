<?php


namespace App\Repositories\Base;


abstract class BaseRepository
{
    abstract public function getAll();

    abstract public function getById($id);

    abstract public function getAllMy();
}
