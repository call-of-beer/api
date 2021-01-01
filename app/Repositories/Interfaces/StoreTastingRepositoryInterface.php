<?php


namespace App\Repositories\Interfaces;


interface StoreTastingRepositoryInterface
{
    public function store($data, $group, $beer);
}
