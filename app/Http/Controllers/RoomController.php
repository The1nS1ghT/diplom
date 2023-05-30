<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
   public function showForCreateRoom($id)
   {
      $hotel = DB::table('hotels')->select('*')->where('id_hotel', '=', $id)->get();
      $services = DB::table('services')->select('*')->get();
      return view('managerViews/showForCreateRoom', compact('services', 'hotel'));
   }

   // public function showForCreateRoom($id)
   // {
   //    $hotel = DB::table('hotels')->select('*')->where('id_hotel', '=', $id);
   //    return view('managerViews/showForCreateRoom', compact('hotel'));
   // }
   //CREATE ROOMS
   public function create($id, Request $request)
   {
      $array = array();
      $idroom = array();
      $data = $request->all();
      $services[] = $request->input('services');
      foreach ($services as $idr) {
      }
      foreach ($idr as $services) {
         $i = DB::table('services')->select('id_services')->where('name_services', 'like', $services)->get();
         foreach ($i as $ids) {
            foreach ($ids as $id_services) {
            }
         }
         array_push($array, $id_services);
      }


      //dd($id);
      for ($i = 0; $i < $data['quantity_room']; $i++) {
         DB::table('rooms')->insert([
            'id_hotel' => $id,
            'type_room' => $data['type_room'],
            'type_food' => $data['type_food'],
            'type_bed' => $data['type_bed'],
            'square_room' => $data['square_room'],
            'booked' => false,
            'price_per_night' => $data['price_per_night']
         ]);
      }
      $hotel = DB::table('rooms')
         ->select('id_room')
         ->where('type_room', 'like', $data['type_room'])
         ->where('id_hotel', '=', $id)
         ->get();

      $hotel = $hotel->toArray();
      foreach ($hotel as $id) {
         foreach ($id as $i) {
         }
         array_push($idroom, $i);
      }
      //dd($idroom, $data['quantity_room']);

      for ($i = 0; $i < count($array); $i++) {
         for ($q = 0; $q < $data['quantity_room']; $q++) {
            DB::table('provides')->insert([
               'id_services' => $array[$i],
               'id_room' => $idroom[$q],
            ]);
         }
      }
   }
   public function show($id, $room)
   {
      $rooms = DB::table('rooms')
         ->join('provides', 'rooms.id_room', '=', 'provides.id_room')
         ->join('services', 'services.id_services', '=', 'provides.id_services')
         ->join('hotels', 'hotels.id_hotel', '=', 'rooms.id_hotel')
         ->where('rooms.id_hotel', '=', $id,)
         ->where('rooms.type_room', '=', $room)
         ->select('*')
         ->distinct('services.name_services')
         ->get();

      return view('managerViews/roomDetails', compact('rooms'));
   }

   public function showForAddService($id, $type_room)
   {
      $data = DB::table('rooms')
         ->join('provides', 'rooms.id_room', '=', 'provides.id_room')
         ->join('services', 'services.id_services', '=', 'provides.id_services')
         ->join('hotels', 'hotels.id_hotel', '=', 'rooms.id_hotel')
         ->where('rooms.id_hotel', '=', $id,)
         ->where('rooms.type_room', '=', $type_room)
         ->select('*')
         ->distinct('services.name_services')
         ->get();

      $services = DB::table('services')
         ->select('name_services')
         ->get();
      return view('managerViews/showForAddService', compact('data', 'services'));
   }

   public function addedService($id, $type_room, Request $request)
   {
      //dd($id);
      $arrayId = array();
      $arrayServices = array();
      $services[] = $request->input('services');
      foreach ($services as $service) {
      }


      foreach ($service as $services) {
         $i = DB::table('services')->select('id_services')->where('name_services', 'like', $services)->get();
         foreach ($i as $ids) {
            foreach ($ids as $id_services) {
            }
         }
         array_push($arrayServices, $id_services);
      }

      $room = DB::table('rooms')
         ->select('id_room')
         ->where('type_room', 'like', $type_room)
         ->where('id_hotel', '=', $id)
         ->get();

      $romAr =  $room->toArray();

      foreach ($romAr as $r) {
         foreach ($r as $ro) {
         }
         array_push($arrayId, $ro);
      }
      //dd($arrayId);
      for ($i = 0; $i < count($arrayServices); $i++) {
         for ($k = 0; $k < count($arrayId); $k++)
            DB::table('provides')->insert([
               'id_services' => $arrayServices[$i],
               'id_room' => $arrayId[$k]
            ]);
      }
      return back();
   }

   public function deleteService($id, $type_room, Request $request)
   {

      $servArray = array();
      $data[] = $request->input('services');
      foreach ($data as $service) {
      }
      foreach ($service as $services) {
         $i = DB::table('services')->select('id_services')->where('name_services', 'like', $services)->get();
         foreach ($i as $ids) {
            foreach ($ids as $id_services) {
            }
         }
         array_push($servArray, $id_services);
      }
      // $data = DB::table('services')
      //    ->join('provides', 'services.id_services', '=', 'provides.id_services')
      //    ->join('rooms', 'provides.id_room', '=', 'rooms.id_room')
      //    ->join('hotels', 'rooms.id_hotel', '=', 'hotels.id_hotel')
      //    ->select('provides.id_services', 'rooms.id_room')
      //    ->where('hotels.id_hotel', '=', $id)
      //    ->where('rooms.type_room', '=', $type_room)
      //    ->get();
      for ($i = 0; $i < count($servArray); $i++) {
         $data = DB::table('provides')
            ->join('rooms', 'rooms.id_room', '=', 'provides.id_room')
            ->select('*')
            ->where('provides.id_services', '=', $servArray[$i])
            ->where('rooms.type_room', '=', $type_room)
            ->where('rooms.id_hotel', '=', $id)
            ->get();
      }
      $arrayIdRoom = array();
      $arrayIdServices = array();
      foreach ($data as $idr) {
         array_push($arrayIdRoom, $idr->id_room);
         array_push($arrayIdServices, $idr->id_services);
      }

      //dd($arrayIdRoom, $servArray);
      //dd($data);

      for ($i = 0; $i < count($servArray); $i++) {
         for ($k = 0; $k < count($arrayIdRoom); $k++) {
            DB::table('provides')
               ->where('id_room', '=', $arrayIdRoom[$k])
               ->where('id_services', '=', $servArray[$i])
               ->delete();
         }
      }
      return back();
      //dd($servArray, $id, $type_room);
   }

   public function update()
   {
   }
   public function delete($id, $type_room)
   {
      $data = DB::table('services')
         ->join('provides', 'services.id_services', '=', 'provides.id_services')
         ->join('rooms', 'provides.id_room', '=', 'rooms.id_room')
         ->join('hotels', 'rooms.id_hotel', '=', 'hotels.id_hotel')
         ->select('provides.id_services', 'rooms.id_room')
         ->where('hotels.id_hotel', '=', $id)
         ->where('rooms.type_room', '=', $type_room)
         ->get();

      $arrayIdRoom = array();
      $arrayIdServices = array();
      foreach ($data as $idr) {
         array_push($arrayIdRoom, $idr->id_room);
         array_push($arrayIdServices, $idr->id_services);
      }

      for ($i = 0; $i < count($arrayIdRoom); $i++) {
         DB::table('provides')
            ->where('id_room', '=', $arrayIdRoom[$i])
            ->delete();
      }
      for ($i = 0; $i < count($arrayIdRoom); $i++) {
         DB::table('rooms')
            ->where('id_room', '=', $arrayIdRoom[$i])
            ->delete();
      }
      return back();
   }
}
