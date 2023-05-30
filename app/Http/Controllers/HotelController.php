<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class HotelController extends Controller
{
   public function show()
   {
      $hotels = DB::table('hotels')
         ->join('cities', 'hotels.id_city', '=', 'cities.id_city')
         ->join('countries', 'cities.id_country', '=', 'countries.id_country')
         ->select('*')
         ->get();
      return view('managerViews/showHotels', compact('hotels'));
   }
   public function showDetails($id)
   {
      $data = DB::table('hotels')->where('id_hotel', '=', $id)->select('*')->get();

      $room = DB::table('hotels')
         ->join('rooms', 'hotels.id_hotel', '=', 'rooms.id_hotel')
         ->where('hotels.id_hotel', '=', $id)
         ->select('*')
         ->distinct('rooms.type_room')
         ->get();

      $comment = DB::table('hotels')
         ->join('comments', 'hotels.id_hotel', '=', 'comments.id_hotel')
         ->join('users', 'comments.id', '=', 'users.id')
         ->select('*')
         ->where('hotels.id_hotel', '=', $id)
         ->get();

      return view('managerViews/hotelDetails', compact('data', 'comment', 'room'));
   }
   public function showForCreate()
   {
      $cities = DB::table('cities')->select('name_city')->get();
      $rooms = DB::table('rooms')->select('*')->get();
      return view('managerViews/showForCreateHotel', compact('cities', 'rooms'));
   }
   public function create(Request $request)
   {
      $name_city = $request->input('name_city');
      $id_city = DB::table('cities')->where('name_city', 'like', $name_city)->select('id_city')->get();

      foreach ($id_city as $id) {
         foreach ($id as $idc) {
         }
      }
      //dd($idc);

      $data = $request->all();
      $quan = $request->input('quantity_room');

      $services = DB::table('hotels')->insert([
         'id_city' => $idc,
         'name_hotel' => $data['name_hotel'],
         'address_hotel' => $data['address_hotel'],
         'contacts_hotel' => $data['contacts_hotel'],
         'site_hotel' => $data['site_hotel'],
      ]);
      // $lastId = DB::getPdo()->lastInsertId();
      // //dd($data['type_room'], $data['type_food'], $quan);

      // for ($i = 0; $i < $quan; $i++) {
      //    DB::table('rooms')->insert([
      //       'id_hotel' => $lastId,
      //       'type_room' => $data['type_room'],
      //       'type_food' => $data['type_food'],
      //       'type_bed' => $data['type_bed'],
      //       'booked' => false
      //    ]);
      // }
      return back();
   }
   public function showForUpdate($id)
   {
      $hotel = DB::table('hotels')
         ->where('id_hotel', '=', $id)
         ->select('*')
         ->get();
      return view('managerViews/showForUpdateHotel', compact('hotel'));
   }


   public function update($id, Request $request)
   {
      $array = array();
      $name_hotel = $request->input('name_hotel');
      $stars_hotel = $request->input('stars_hotel');
      $quantity_room_all = $request->input('quantity_room_all');
      $address_hotel = $request->input('address_hotel');
      $contacts_hotel = $request->input('contacts_hotel');


      $name_services[] = $request->input('name_services');

      //dd($name_hotel, $stars_hotel, $quantity_room_all, $address_hotel, $contacts_hotel);

      foreach ($name_services as $quan) {
      }

      //dd($name_services, $quan);
      foreach ($quan as $q) {
         $idd = DB::table('services')->where('name_services', '=', $q)->select('id_services')->get();
         foreach ($idd as $i) {
            foreach ($i as $d) {
            }
         }
         array_push($array, $d);
      }
      //dd($array);

      DB::table('hotels')->where('id_hotel', '=', $id)->update([
         'name_hotel' => $name_hotel,
         'stars_hotel' => $stars_hotel,
         'quantity_room_all' => $quantity_room_all,
         'address_hotel' => $address_hotel,
         'contacts_hotel' => $contacts_hotel
      ]);

      // for ($i = 0; $i < count($array); $i++) {
      //    $services = DB::table('provides')->where('id_hotel', '=', $id)->delete([
      //       'id_services' => $array[$i]
      //    ]);
      // }

      return back();
   }
   public function delete()
   {
   }

   public function showForDelService($id, $type)
   {
      $serviceInRoom = DB::table('services')
         ->join('provides', 'provides.id_services', '=', 'services.id_services')
         ->join('rooms', 'rooms.id_room', '=', 'provides.id_room')
         ->join('hotels', 'hotels.id_hotel', '=', 'rooms.id_hotel')
         ->select('hotels.id_hotel', 'services.name_services', 'services.id_services', 'services.availability_services', 'rooms.type_room')
         ->where('rooms.type_room', '=', $type)
         ->where('hotels.id_hotel', '=', $id)
         ->distinct()
         ->get();

      $services = DB::table('services')
         ->select('*')
         ->get();
      return view('managerViews/showForDelService', compact('serviceInRoom', 'services'));
   }





   public function createComment($id, Request $request)
   {
      $data = $request->all();

      $date = date('Y-m-d H:i:s');
      DB::table('comments')->insert([
         'id_hotel' => $id,
         'id' => Auth::user()->id,
         'comment' => $data['comment'],
         'date_comment' => $date,
      ]);

      return back();
   }
}
