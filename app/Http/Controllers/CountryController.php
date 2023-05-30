<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
   public function show()
   {
      $co = Country::all();
      //dd($co);
      return view('countryViews/countries', compact('co'));
   }
   public function getCountryDetails($id)
   {
      $data = DB::table('countries')->where('id_country', '=', $id)->select('*')->get();
      return view('countryViews/countryDetails', compact('data'));
      //dd($countrydetail);
   }

   public function showForCreate()
   {
      return view('adminViews/showForCreateCountry');
   }
   public function create(Request $request) // ДОБАВИТЬ СООБЩЕНИЕ ОБ УСПЕШНОМ ДОБАВЛЕНИИ
   {

      $data = $request->all();

      DB::table('countries')->insert([
         'name_country' => $data['name_country'],
         'phone_country' => $data['phone_country'],
         'currently_country' => $data['currently_country'],
         'continent_country' => $data['continent_country'],
         'description_country' => $data['description_country']
      ]);

      // $country = new Country();
      // $country->name_country = request('name_country'); //пишем данные в таблицу
      // $country->phone_country = request('phone_country');
      // $country->currently_country = request('currently_country');
      // $country->continent_country = request('continent_country');
      // $country->description_country = request('description_country'); //пишем данные в таблицу
      // $country->save(); //сохраняем
      return back();
   }

   public function showForUpdate($id)
   {
      $data = DB::table('countries')->where('id_country', '=', $id)->select('*')->get();
      return view('adminViews/showForUpdateCountry', compact('data'));
   }

   public function update($id, Request $request)
   {
      $name_country = $request->input('name_country');
      $phone_country = $request->input('phone_country');
      $currently_country = $request->input('currently_country');
      $continent_country = $request->input('continent_country');
      $description_country = $request->input('description_country');


      DB::table('countries')->where('id_country', '=', $id)->update([
         'name_country' => $name_country,
         'phone_country' => $phone_country,
         'currently_country' => $currently_country,
         'continent_country' => $continent_country,
         'description_country' => $description_country
      ]);

      // return view('countryViews/countries');
      return back();
   }
}
