<?php


namespace App\Services\Interfaces;


interface TypesBeerServiceInterface
{
    public function getAll();

    public function addNew($data);

    public function remove($typesBeer);
}
