<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    //
    public function index()
    {
        $countries = Country::get();
        return view('admin.siteSettings.city.index', compact('countries'));
    }
    public function getCityList()
    {
        $cities = City::select(['cities.id', 'cities.name', 'countries.name as country_name'])
            ->leftJoin('countries', 'cities.country_id', '=', 'countries.id')
            ->get();

        return DataTables::of($cities)->make(true);
    }
    public function storeCity(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'city_name' => 'required|unique:cities',
        //     'country_id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()->all()]);
        // }
        $city = new City();
        $city->name = $request->city_name;
        $city->country_id = $request->country_id;
        $city->save();
        return response()->json(['success' => 'City added successfully.']);
    }
}
