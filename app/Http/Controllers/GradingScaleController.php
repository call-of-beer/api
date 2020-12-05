<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradingScaleRequest;
use App\Models\GradingScale;
use App\Services\gradingScalesService;
use Illuminate\Http\Request;

class GradingScaleController extends Controller
{
   private $gradingScaleService;

   public function __construct(gradingScalesService $gradingScaleService)
   {
       $this->gradingScaleService = $gradingScaleService;
   }

   public function index()
   {
       return $this->gradingScaleService->getAll();
   }

   public function store(GradingScaleRequest $request)
   {
       return $this->gradingScaleService->addNew($request);
   }

   public function destroy(GradingScale $gradingScale)
   {
       return $this->gradingScaleService->remove($gradingScale);
   }
}
