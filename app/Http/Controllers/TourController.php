<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Configuration\Merger;
use Psy\Command\WhereamiCommand;

class TourController extends Controller
{
   public function showForCreate()
   {
      $hotel = DB::table('hotels')
         // ->join('rooms', 'rooms.id_hotel', '=', 'hotels.id_hotel')
         ->select('*')
         ->get();
      return view('tours/showForCreateTour', compact('hotel'));
   }
   public function create(Request $request)
   {
      $data = $request->all();

      $first = $data['date_arrival_tour'];
      $second = $data['date_departure_tour'];

      $date1 = date_create($first);
      $date2 = date_create($second);

      $diff = date_diff($date1, $date2);
      $date = $diff->format('%d');

      $idHotel = DB::table('hotels')
         ->select('id_hotel')
         ->where('name_hotel', '=', $data['name_hotel'])
         ->get();

      foreach ($idHotel as $i) {
         foreach ($i as $id) {
         }
      }

      //dd($id);
      $min = DB::table('rooms')
         ->where('id_hotel', '=', $id)
         ->min('price_per_night');

      $price = $date * $min;


      DB::table('tours')
         ->insert([
            'id_hotel' => $id,
            'name_tour' => $data['name_tour'],
            'type_tour' => $data['type_tour'],
            'desc_tour' => $data['desc_tour'],
            'price_tour' => $price,
            'date_arrival_tour' => $data['date_arrival_tour'],
            'date_departure_tour' => $data['date_departure_tour'],
            'nights' => $date
         ]);

      //dd($date, $id, $min, $price);
      return back();
   }
   public function show()
   {
      $idr = array();
      $tours = DB::table('tours')
         ->join('hotels', 'hotels.id_hotel', '=', 'tours.id_hotel')
         ->select('*')
         ->get();
      $id_room = DB::table('rooms')
         ->select('type_room')
         ->where('id_hotel', '=', '6')
         ->distinct()
         ->get();
      foreach ($id_room as $id) {
         foreach ($id as $id_room) {
         }
         array_push($idr, $id_room);
      }
      //dd($tours);
      return view('tours/showTour', compact('tours'));
   }
   public function showDetails($id_hotel, $id_tour)
   {
      //dd($id_room);
      $tour = DB::table('tours')
         ->join('hotels', 'hotels.id_hotel', '=', 'tours.id_hotel')
         ->join('rooms', 'hotels.id_hotel', '=', 'rooms.id_hotel')
         ->join('provides', 'rooms.id_room', '=', 'provides.id_room')
         ->join('services', 'services.id_services', '=', 'provides.id_services')
         ->select('*')
         ->distinct('rooms.type_room', 'rooms.type_food')
         ->where('tours.id_tour', '=', $id_tour)
         ->where('tours.id_hotel', '=', $id_hotel)
         ->get();

      $room = DB::table('rooms')
         ->join('hotels', 'hotels.id_hotel', '=', 'rooms.id_hotel')
         ->join('provides', 'provides.id_room', '=', 'rooms.id_room')
         ->join('services', 'services.id_services', '=', 'provides.id_services')
         ->select('services.name_services')
         ->distinct('services.name_services')
         ->where('hotels.id_hotel', '=', $id_hotel)
         ->get();
      //dd($room);
      return view('tours/tourDetails', compact('tour', 'room'));
   }
   public function showRoomDetails($id_hotel, $id_tour, $type_room)
   {
      $services = DB::table('rooms')
         ->join('hotels', 'hotels.id_hotel', '=', 'rooms.id_hotel')
         ->join('provides', 'provides.id_room', '=', 'rooms.id_room')
         ->join('services', 'services.id_services', '=', 'provides.id_services')
         ->select('services.name_services')
         ->distinct('services.name_services')
         ->where('hotels.id_hotel', '=', $id_hotel)
         ->where('rooms.type_room', '=', $type_room)
         ->get();
      dd($services);
      return view('tours.showRoomDetails', compact('services'));
      //dd($room);
      //dd($type_room, $id_tour, $id_hotel);
   }

   public function choiseTicket($id_hotel, $id_tour, $type_room)
   {
      //ПОЛУЧИТЬ ВСЕ БИЛЕТЫ НА ЭТУ ДАТУ
      date_default_timezone_set("Europe/Moscow");
      //echo date_default_timezone_get();
      $date = date('Y-m-d H:i:s');
      //dd($date);
      $arrayDateDeparture = array();
      $arrayDateArrival = array();
      //dd($id_hotel);
      $price = DB::table('rooms')
         ->select('price_per_night')
         ->where('id_hotel', '=', $id_hotel)
         ->where('type_room', 'like', $type_room)
         ->distinct('price_per_night')
         ->get();

      foreach ($price as $pricePerNight) {
         foreach ($pricePerNight as $price) {
         }
      }


      $night = DB::table('tours')
         ->select('nights')
         ->where('id_tour', '=', $id_tour)
         ->get();
      foreach ($night as $nights) {
         foreach ($nights as $night) {
         }
      }
      //dd($night);
      $pricePerRoom = $night * $price;
      //dd($pricePerRoom);

      $dateTour = DB::table('tours')
         ->select('date_arrival_tour', 'date_departure_tour')
         ->where('id_tour', '=', $id_tour)
         ->get();

      foreach ($dateTour as $da) {
      }
      $dateArrival = $da->date_arrival_tour;
      $dateDeparture = $da->date_departure_tour;
      //dd($dateArrival, $dateDeparture);

      //dd($arrayDateArrival, $arrayDateDeparture);
      $name_city = DB::table('tours')
         ->join('hotels', 'hotels.id_hotel', '=', 'tours.id_hotel')
         ->join('cities', 'cities.id_city', '=', 'hotels.id_city')
         ->select('cities.name_city')
         ->where('tours.id_hotel', '=', $id_hotel)
         ->get();
      //dd($datearr);
      foreach ($name_city as $city) {
         foreach ($city as $name_city) {
         }
      }
      $ticketsDeparture = DB::table('tickets')
         ->select('*')
         ->where('date_arrival_ticket', '=', $dateArrival)
         //->where('date_departure_ticket', '<=', $arrayDateDeparture)
         ->where('departure_place_ticket', 'like', 'Москва')
         ->where('arrival_place_ticket', 'like', $name_city)
         ->where('tickets.redeemed', '=', false)
         ->distinct('price_ticket', 'date_arrival_ticket', 'date_departure_ticket')
         ->orderBy('price_ticket', 'ASC')
         ->get()
         ->toArray();

      foreach ($ticketsDeparture as $ticket) {
      }
      $city_back = $ticket->departure_place_ticket;

      $ticketsArrival = DB::table('tickets')
         ->select('*')
         ->where('date_arrival_ticket', '=', $dateDeparture)
         ->where('arrival_place_ticket', 'like', $city_back)
         ->where('tickets.redeemed', '=', false)
         //->union($ticket)
         ->distinct('price_ticket', 'date_arrival_ticket', 'date_departure_ticket')
         ->orderBy('price_ticket', 'ASC')
         ->get()
         ->toArray();
      foreach ($ticketsArrival as $ticketBack) {
      }

      $result = array();
      $arr = array();
      for ($i = 0; $i < count($ticketsDeparture); $i++) {
         array_push($result, $ticketsDeparture[$i]);
         array_push($result, $ticketsArrival[$i]);
      }
      // foreach ($result as $data) {
      // }
      $arr = array_chunk($result, 2);
      // foreach ($arr as $data) {
      // }
      //dd($arr);

      // dd($result);
      //dd($ticketsDeparture, $ticketsArrival);
      return view('tours.showTicketsForOrd', compact('arr'));
   }

   public function confirmTicket($date1, Request $request)
   {
      $data = $request->all();
      dd($data, $date1);
   }


   public function showForUpdate()
   {
   }
   public function update()
   {
   }
   public function delete()
   {
   }

   //ПОИСК ТУРА ПО ФОРМЕ

   // public function showCityForSearchTour()
   // {
   //    $cities = DB::table('cities')
   //       ->select('name_city')
   //       ->orderBy('name_city')
   //       ->get();


   //    return view('layouts/index', compact('cities'));
   // }
   public function searchTour(Request $request)
   {


      $data = $request->all();

      $date_arrival_ticket = date_create($data['date_arrival_ticket']);
      $date_departure_ticket = date_create($data['date_departure_ticket']);

      $diff = date_diff($date_arrival_ticket, $date_departure_ticket);
      $nights = $diff->format('%D');
      //dd($nights);

      date_default_timezone_set("Europe/Moscow");
      //echo date_default_timezone_get();
      $date = date('Y-m-d');
      //$date = date('Y-m-d H:i:s');
      //dd($date);
      $tours = DB::table('tours')
         ->join('hotels', 'hotels.id_hotel', '=', 'tours.id_hotel')
         ->join('cities', 'hotels.id_city', '=', 'cities.id_city')
         ->select('*')
         ->where('cities.name_city', 'like', $data['place_arrival'])
         ->where('date_arrival_tour', '=', $data['date_departure_ticket'])
         ->where('date_departure_tour', '>', $date)
         ->where('date_arrival_tour', '>', $date)
         ->where('nights', '=', $nights)
         ->get();
      //dd($tours);
      return view('tours/showTour', compact('tours'));
   }
}

class ticket
{
}
