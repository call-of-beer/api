<?php


namespace App\Repositories\Interfaces;


interface GetsCommentsRepositoryInterface
{
    public function getCommentsOfTasting($tasting);

    public function getMyComments();
}
