<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasteAttributeRequest;
use App\Models\Beer;
use App\Models\TasteAttributes;
use App\Services\TasteAttributesService;
use Illuminate\Http\Request;

class TasteAttributesController extends Controller
{
    private $tasteAttributesService;

    public function __construct(TasteAttributesService $tasteAttributesService)
    {
        $this->tasteAttributesService = $tasteAttributesService;
    }

    public function index()
    {
        return $this->tasteAttributesService->getAll();
    }

    public function store(TasteAttributeRequest $request, Beer $beer)
    {
        return $this->tasteAttributesService->storeNew($request, $beer);
    }

    public function destroy(TasteAttributes $tasteAttributes)
    {
        return $this->tasteAttributesService->remove($tasteAttributes);
    }
}
