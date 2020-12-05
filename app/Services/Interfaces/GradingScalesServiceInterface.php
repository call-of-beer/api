<?php


namespace App\Services\Interfaces;


interface GradingScalesServiceInterface
{
    public function getAll();

    public function addNew($data);

    public function remove($gradingScale);
}
