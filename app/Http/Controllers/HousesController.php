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

        // FIlters
        if (isset($params['house_filters'])) {
            $houseFilters = json_decode($params['house_filters']);

            // House count filter
            if (isset($houseFilters->houseCount)) $house_count = $houseFilters->houseCount;

            // House Bugdet filter
            if (isset($houseFilters->priceRange)) {
                if (!$houseFilters->priceRange->any) {
                    if ($houseFilters->priceRange->useSpecificPrice) // Use Specific price
                        $houses->where('rent', $houseFilters->priceRange->specificPrice);
                    else // Use range
                        $houses->whereBetween('rent', [$houseFilters->priceRange->from, $houseFilters->priceRange->to]);
                }
            }

            // Rooms Filter
            if (isset($houseFilters->rooms)) {
                if (!$houseFilters->rooms->any) {
                    $rooms = [];
                    if ($houseFilters->rooms->useSpecificRooms) { // Use specific
                        foreach ($houseFilters->rooms->specificRooms as $room) $rooms[] = $room->value;
                        $houses->whereIn('rooms', $rooms);
                    } else { // Use range
                        foreach ($houseFilters->rooms->rooms as $room) $rooms[] = $room->value;
                        $houses->whereIn('rooms', $rooms);
                    }
                }
            }

            // Location filter
            if (isset($houseFilters->locations)) {
                if (!$houseFilters->locations->any) {
                    $locationIds = [];
                    foreach ($houseFilters->locations->locations as $location) $locationIds[] = $location->id;
                    $houses->whereIn('location_id', $locationIds);
                }
            }
        }

        $houses = $houses->paginate($house_count);

        foreach ($houses as $house) {
            $house->location;
            $house->images;
            $house->landlords;
            foreach ($house->landlords as $landlord) {
                $landlord->contacts;
            }
        }

        return response([
            'success' => true,
            'houses' => $houses->toArray(),
        ], 201);
    }
}
