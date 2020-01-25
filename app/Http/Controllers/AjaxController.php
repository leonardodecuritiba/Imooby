<?php

namespace App\Http\Controllers;

use App\Models\PropertiesType;
use App\Models\Property;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    static public function searchJsonProperties(Request $request)
    {
        return (Property::getByBounds($request->all()));
    }
    static public function searchProperties($data)
    {
        $Properties = Property::getByLocation($data);
        if($Properties->count()>0){
            $Filters = [
                'rental'        => ['min' => $Properties->min('price_total'), 'max' => $Properties->max('price_total')],
                'bedroom'       => ['min' => $Properties->min('bedrooms'), 'max' => $Properties->max('bedrooms')],
                'bathroom'      => ['min' => $Properties->min('bathrooms'), 'max' => $Properties->max('bathrooms')],
                'garage'      => ['min' => $Properties->min('garages'), 'max' => $Properties->max('garages')],
                'internal_area' => ['min' => $Properties->min('internal_area'), 'max' => $Properties->max('internal_area')],
                'type'          => PropertiesType::whereIn('id',$Properties->pluck('idproperties_type'))->get(),
            ];
        } else {
            $Filters = NULL;
        }
        return ([
            'Properties' => $Properties,
            'PropertiesFilters' => json_encode($Filters),
        ]);
    }


}
