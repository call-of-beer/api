<?php


namespace App\Services\Interfaces;


interface TastingServicesInterfaces
{
    public function getAll();

    public function store($data, $group, $beer);
}
