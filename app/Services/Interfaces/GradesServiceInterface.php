<?php


namespace App\Services\Interfaces;


interface GradesServiceInterface
{
    public function storeToIngredient($data, $beer, $ingredient);

    public function storeToRating();

    public function getOverallIngredient($ingredient, $beer);
}
