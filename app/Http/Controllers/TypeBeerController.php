<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeBeerRequest;
use App\Models\TypeBeer;
use App\Services\TypesBeerService;
use Illuminate\Http\Request;

class TypeBeerController extends Controller
{
    private $typesBeerService;

    public function __construct(TypesBeerService $typesBeerService)
    {
        $this->typesBeerService = $typesBeerService;
    }

    public function index()
    {
        return $this->typesBeerService->getAll();
    }

    public function store(TypeBeerRequest $request)
    {
        return $this->typesBeerService->addNew($request);
    }

    public function getTypeBeer(TypeBeer $typeBeer)
    {
        return $this->typesBeerService->getById($typeBeer);
    }

    public function destroy(TypeBeer $typeBeer)
    {
        return $this->typesBeerService->remove($typeBeer);
    }
}
