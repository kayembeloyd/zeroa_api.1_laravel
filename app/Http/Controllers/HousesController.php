<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Location;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();

        $house_count = 7;

        $houses = House::orderBy('available_on', 'DESC');

        // $debugInfo = [];

        // Debugging
        // if (isset($params['client'])) $debugInfo['client'] = $params['client'];

        // FIlters
        if (isset($params['house_filters'])) {
            // $debugInfo['house_filters'] = $params['house_filters'];

            $houseFilters = json_decode($params['house_filters']);

            // House count filter
            if (isset($houseFilters->houseCount)) $house_count = $houseFilters->houseCount;

            // House Bugdet filter
            if (isset($houseFilters->rentFeeExact)) {
                $houses->where('rent_fee', $houseFilters->rentFeeExact);
            } else if (isset($houseFilters->rentFeeFrom) && isset($houseFilters->rentFeeTo)) {
                $houses->whereBetween('rent_fee', [$houseFilters->rentFeeFrom, $houseFilters->rentFeeTo]);
            }

            // Rooms Filter
            if (isset($houseFilters->rooms)) {
                if ($houseFilters->rooms != "") {
                    if (!in_array("Any", explode(',', $houseFilters->rooms))) {
                        $houses->whereIn('number_of_rooms', explode(',', $houseFilters->rooms));
                    }
                }
            }

            // Location filter
            if (isset($houseFilters->additionalLocations) && !empty($houseFilters->additionalLocations)) {
                $location_ids = Location::whereIn('name', array_column($houseFilters->additionalLocations, 'desc'))->pluck('id')->toArray();
                $houses->whereIn('location_id', $location_ids);
            }
        }

        $houses = $houses->paginate($house_count);

        foreach ($houses as $house) {
            $house->location;
            $house->images;
            $house->landlords;
        }

        // More filters
        return response([
            'success' => true,
            'houses' => $houses->toArray(),
            // 'debug_info' => $debugInfo
        ], 201);
    }
}
