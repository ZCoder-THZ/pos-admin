<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;
use DataTables;

class CountryController extends Controller
{
    public function index()
    {
        return view('admin.siteSettings.country.index');
    }
    public function getCountryList()
    {
        $countries = Country::select(['id', 'name']);

        return DataTables::of($countries)
            ->addColumn('action', function ($data) {
                $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm editCountry">Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Add City</button>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function updateCountry(Request $request)
    {
        try {
            $country = Country::find($request->id);
            $country->name = $request->country;
            $country->save();
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function deleteCountry($id)
    {
        try {
            Country::where('id', $id)->delete();
            return response()->json(['message' => 'Country deleted successfully.'], 200, $headers);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
