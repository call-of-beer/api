<?php


namespace App\Services\Interfaces;


interface BeerServiceInterface
{
    public function getAllBeers();

    public function getAllMyBeers();

    public function getBeerById($beer);
}
