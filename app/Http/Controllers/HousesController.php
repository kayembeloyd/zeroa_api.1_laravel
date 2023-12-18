<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();

        $house_count = 7;

        $houses = House::orderBy('available_on', 'DESC');

        // Filtration
        // House count
        if (isset($params['house_count'])) $house_count = $params['house_count'];

        // Budget range
        if (isset($params['rent_fee_min']) && isset($params['rent_fee_max'])) $houses->whereBetween('rent_fee', [$params['rent_fee_min'], $params['rent_fee_max']]);
        else if (isset($params['rent_fee'])) $houses->where('rent_fee', $params['rent_fee']);

        // Location
        if (isset($params['location'])) $houses->where('location_id', isset($params['location']));

        // Rooms
        if (isset($params['rooms'])) $houses->whereIn('number_of_rooms', explode(',', $params['rooms']));

        $houses = $houses->paginate($house_count);

        foreach ($houses as $house) {
            $house->location;
            $house->images;
            $house->landlords;
        }

        // More filters
        return response([
            'success' => true,
            'houses' => $houses->toArray()
        ], 201);
    }
}
