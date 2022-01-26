<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CountryController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }
    public function AllCities(){
        $countries = Countries::all();
        return view('admin/countries.index', compact('countries'));

    }

    public function AddCountry(Request $request){

        $validated = $request->validate([
            'country_name' => 'required|max:255',


        ]);


        $City = new Countries();
        $City->name = $request->country_name;
        $City->save();

       return Redirect()->back()->with('success', 'Country inserted successfully');
    }

    public function editCounty($id){
            $countries = Countries::find($id);
            return view('admin/countries.edit',compact('countries'));
    }

    public function updateCountry(Request $request , $id){
            $update = Countries::find($id)->update([
                'name' => $request->country_name
            ]);
        return Redirect()->route('all.countries')->with('success', 'Country updated successfully');

    }

    public function deleteCountry($id){

        $countries = Countries::find($id);
        $countries->delete();

        return Redirect()->route('all.countries')->with('success', 'Country deleted successfully');
    }
}
