<?php


namespace App\Services\Interfaces;


interface StoreUpdateDeleteBeersInterface
{
    public function storeBeer($data, $typebeer, $country);

    public function editBeer($data, $beer);

    public function deleteBeer($beer);
}
