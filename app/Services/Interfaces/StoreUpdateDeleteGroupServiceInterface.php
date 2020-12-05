<?php


namespace App\Services\Interfaces;


interface StoreUpdateDeleteGroupServiceInterface
{
    public function storeGroup($data);

    public function editGroup($group, $data);

    public function deleteGroup($group);
}
