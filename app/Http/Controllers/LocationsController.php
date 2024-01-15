<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::orderBy('name', 'ASC')->paginate(100);

        return response([
            'success' => true,
            'locations' => $locations->toArray(),
        ], 201);
    }
}
