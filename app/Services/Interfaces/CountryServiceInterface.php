<?php


namespace App\Services\Interfaces;


interface CountryServiceInterface
{
    public function getAll();

    public function storeNew($data);

    public function remove($country);
}
