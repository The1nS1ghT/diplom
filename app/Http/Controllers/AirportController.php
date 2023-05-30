<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirportController extends Controller
{
   public function showForCreate()
   {
      $city = City::all();
      return view('adminViews/showForCreateAirport', compact('city'));
   }
   public function create(Request $request)
   {
      $name_city = $request->input('name');
      $name_airport = $request->input('name_airport');
      $code_ikao = $request->input('code_ikao');
      $code_iata = $request->input('code_iata');
      //dd($name_city, $code_ikao, $code_iata);

      $idCity = DB::table('cities')
         ->select('id_city')
         ->where('name_city', '=', $name_city)
         ->get();

      foreach ($idCity as $id) {
         foreach ($id as $idCity) {
         }
      }

      DB::table('airport')->insert([
         'id_city' => $idCity,
         'name_airport' => $name_airport,
         'ikao_code_airport' => $code_ikao,
         'iata_code_airport' => $code_iata,
      ]);

      return back();
   }
   public function update()
   {
   }
   public function delete()
   {
   }
}
