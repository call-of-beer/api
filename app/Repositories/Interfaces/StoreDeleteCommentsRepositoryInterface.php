<?php


namespace App\Repositories\Interfaces;


interface StoreDeleteCommentsRepositoryInterface
{
    public function storeComment($tasting, $data);

    public function removeComment($tasting);
}
