<?php


namespace App\Repositories\Interfaces;


interface StoreUpdateDeleteGroupRepositoryInterface
{
    public function store($data);

    public function edit($group, $data);

    public function remove($group);
}
