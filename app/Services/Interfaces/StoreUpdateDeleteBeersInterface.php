<?php


namespace App\Services\Interfaces;


interface StoreUpdateDeleteBeersInterface
{
    public function storeBeer($data);

    public function editBeer($data, $beer);

    public function deleteBeer($beer);
}
