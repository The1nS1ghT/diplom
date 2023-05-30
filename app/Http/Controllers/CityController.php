<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
   public function showForCreate()
   {
      $country = Country::all();
      return view('adminViews/showForCreateCity', compact('country'));
   }
   public function create(Request $request)

   {
      $name = $request->input('name_country');
      $name_c = $request->input('name_city');
      $country = DB::table('countries')
         ->select('id_country')
         ->where('name_country', 'like', $name)->get();

      foreach ($country as $id) {
         foreach ($id as $idCountry) {
         }
      }

      DB::table('cities')->insert([
         'id_country' => $idCountry,
         'name_city' => $name_c
      ]);

      return back();
   }
   public function show()
   {
      $cities = City::all();
      return view('managerViews/showCities', compact('cities'));
   }
   public function update()
   {
   }
   public function delete()
   {
   }
}
