<?php


namespace App\Services\Interfaces;


interface CreateRatingServiceInterface
{
    public function store($beer, $data);

    public function editRating($rating, $data);

    public function delete($rating);
}
