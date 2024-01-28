<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\House;
use App\Models\Image;
use App\Models\Landlord;
use App\Models\Location;
use Carbon\Carbon;
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

    public function create(Request $request)
    {

        // Create the House first
        $house = new House();

        // House general information
        $house->rent = $request->rent ?? 0;
        $house->payment_period = $request->payment_period ?? 1;
        $house->available_on = isset($request->available_on) ?
            Carbon::parse($request->available_on)->format('Y-m-d H:i:s') :
            Carbon::now()->format('Y-m-d H:i:s');
        $house->rooms = $request->rooms ?? 0;
        $house->views = 0;
        $house->details = $request->details ?? "";

        $house->save(); // Save house general information

        // Fetch a location
        if (isset($request->location)) {
            $location = Location::find(json_decode($request->location)->id);
            if ($location) $house->location()->associate($location);

            $house->save(); // Save location
        }


        // Landlord
        if (isset($request->landlordName)) {
            $landlord = Landlord::where('name', $request->landlordName)->first();

            if ($landlord) {
                // assign to tha
                $house->landlords()->save($landlord);
            } else {
                $landlord = new Landlord();
                $landlord->name = $request->landlordName;
                $house->landlords()->save($landlord);

                $landlordContacts = json_decode($request->landlordContacts);

                foreach ($landlordContacts as $landlordContact) {
                    $lc = new Contact();
                    $lc->value = $landlordContact->value;
                    $lc->type = "cell";
                    $landlord->contacts()->save($lc);
                }
            }

            $house->save(); // save landlords
        }

        // Images
        if (isset($request->imageCount)) {
            $imageCount = $request->imageCount;
            for ($i = 0; $i < $imageCount; $i++) {
                if ($request->hasFile('image' . ($i + 1))) {
                    $image = new Image;
                    $path = $request->file('image' . ($i + 1))->store('public/images');
                    $image->path = $path;
                    $image->save();
                    $house->images()->save($image);
                }
            }

            $house->save(); // save images
        }

        echo (json_encode($house));
    }
}
