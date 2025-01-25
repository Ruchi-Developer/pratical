<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class UserController extends Controller
{

    public function fetchCountries()
    {
        $countries = Country::all(['id', 'name']);
        return response()->json($countries);
    }

    public function fetchStates(Request $request) {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function fetchCities(Request $request) {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }


}

