<?php


namespace App\Repositories\Interfaces;


interface StoreEditDeleteBeersRepositoryInterface
{
    public function store();

    public function edit();

    public function remove();
}
