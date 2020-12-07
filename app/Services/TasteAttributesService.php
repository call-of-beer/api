<?php


namespace App\Services;


use App\Models\TasteAttributes;
use App\Services\Interfaces\TasteAttributesServiceInterface;
use App\Traits\ResponseDataTrait;

class TasteAttributesService implements TasteAttributesServiceInterface
{
    use ResponseDataTrait;

    public function getAll()
    {
        $results = TasteAttributes::with(['beer', 'grading_scale'])->get();

        return $this->responseWithData($results, 200);
    }

    public function storeNew($data, $beer)
    {
        $tasteAttr = new TasteAttributes();
        $tasteAttr->name = $data->name;
        $tasteAttr->beer_id = $beer->id;

        $tasteAttr->save();
        return $this->responseWithData($tasteAttr, 200);
    }

    public function remove($tasteAttribute)
    {
        $tasteAttribute->delete();

        return $this->responseWithMessage('Taste Attribute has been removed', 200);
    }
}
