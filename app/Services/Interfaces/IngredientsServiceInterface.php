<?php


namespace App\Services\Interfaces;


interface IngredientsServiceInterface
{
    public function getAll();

    public function store($data, $beer);

    public function destroy($ingredient);
}
