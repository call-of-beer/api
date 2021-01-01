<?php


namespace App\Services\Interfaces;


interface TasteAttributesServiceInterface
{
    public function getAll();

    public function storeNew($data, $beer);

    public function remove($tasteAttribute);
}
