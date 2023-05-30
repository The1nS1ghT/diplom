<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class TicketController extends Controller
{
   public function show()
   {
      $tickets =  DB::table('tickets')
         ->select('*')
         ->get();
      $list = array();
      $luggage = array();





      //dd($test);
      foreach ($tickets as $datee) {
         //dd($datee->date_arrival_ticket);

         $a = strtotime($datee->date_arrival_ticket . "" . $datee->time_arrival_ticket);
         //dd($datee->date_arrival_ticket, $datee->time_arrival_ticket);
         //dd($a);
         $b = strtotime($datee->date_departure_ticket . "" . $datee->time_departure_ticket);


         $test = date('d.m.Y H:i', $a);
         //dd($test);
         $test2 = date('d.m.Y H:i', $b);
         //dd($test, $test2);
         //dd($test);
         $second = $datee->test2;
         $first = $datee->test;


         $date1 = date_create($test);
         $date2 = date_create($test2);

         $diff = date_diff($date1, $date2);
         $date = $diff->format('%H ч %i м');
         array_push($list, $date);
      }
      dd($list);


      return view('managerViews/showTickets', compact('tickets', 'list'));
   }

   public function showForCreate()
   {
      $data = DB::table('cities')
         ->join('airport', 'cities.id_city', '=', 'airport.id_city')
         ->select('cities.name_city', 'airport.*')
         ->get();
      //dd($data);
      return view('managerViews/showForCreateTicket', compact('data'));
   }
   public function showDetails($id)
   {
      $dateDetails = array();
      $data = DB::table('tickets')->where('id_ticket', '=', $id)->select('*')->get();


      foreach ($data as $dates) {
         $second = $dates->date_arrival_ticket;
         $first = $dates->date_departure_ticket;


         $date1 = date_create($first);
         $date2 = date_create($second);

         $diff = date_diff($date1, $date2);
         $date = $diff->format('%H ч %i м');
         array_push($dateDetails, $date);
      }
      return view('managerViews/showDetailsTicket', compact('data', 'dateDetails'));
   }

   public function create(Request $request)
   {
      $data = $request->all();

      $availability_luggage = $request->boolean('availability_luggage');
      //dd($data);

      //$date = $request->date('date_arrival_ticket', '!H:i');
      //dd($date);

      $quantity = $request->input('quantity');

      if ($data['departure_place_ticket'] == $data['arrival_place_ticket'] || $data['iata_code_departure_ticket'] == $data['iata_code_arrival_ticket']) {
         dd('ОШИБКА ВВОДА');
      }

      if ($data['date_departure_ticket'] > $data['date_arrival_ticket']) {
         dd('ОШИБКА ВВОДА ДАТЫ');
      }

      for ($int = 0; $int < $quantity; $int++) {

         DB::table('tickets')->insert([
            'airline_ticket' => $data['airline_ticket'],
            'flight_ticket' => $data['flight_ticket'],
            'name_airplane_ticket' => $data['name_airplane_ticket'],
            'departure_place_ticket' => $data['departure_place_ticket'],
            'arrival_place_ticket' => $data['arrival_place_ticket'],
            'iata_code_departure_ticket' => $data['iata_code_departure_ticket'],
            'iata_code_arrival_ticket' => $data['iata_code_arrival_ticket'],
            'date_departure_ticket' => $data['date_departure_ticket'],
            'date_arrival_ticket' => $data['date_arrival_ticket'],
            'time_departure_ticket' => $data['time_departure_ticket'],
            'time_arrival_ticket' => $data['time_arrival_ticket'],
            'type_flight_ticket' => 'прямой',
            'class_ticket' => $data['class_ticket'],
            'availability_luggage' => $availability_luggage,
            'price_ticket' => $data['price_ticket'],
            'redeemed' => false
         ]);
      }

      return back();
   }

   public function showForUpdate($id)
   {
      $codeiata = DB::table('cities')
         ->join('airport', 'cities.id_city', '=', 'airport.id_city')
         ->select('cities.name_city', 'airport.*')
         ->get();

      $data = DB::table('tickets')->where('id_ticket', '=', $id)->select('*')->get();

      // foreach ($data as $da) {
      // }
      // dd($da);
      return view('managerViews/showForUpdateTicket', compact('data', 'codeiata'));
   }

   public function update($id, Request $request)
   {
      $data = $request->all();
      $availability_luggage = $request->boolean('availability_luggage');
      //dd($availability_luggage);
      if ($data['departure_place_ticket'] == $data['arrival_place_ticket'] || $data['iata_code_departure_ticket'] == $data['iata_code_arrival_ticket']) {
         dd('ОШИБКА ВВОДА');
      }

      if ($data['date_departure_ticket'] > $data['date_arrival_ticket']) {
         dd('ОШИБКА ВВОДА ДАТЫ');
      }

      DB::table('tickets')->where('id_ticket', '=', $id)->update([
         'airline_ticket' => $data['airline_ticket'],
         'flight_ticket' => $data['flight_ticket'],
         'name_airplane_ticket' => $data['name_airplane_ticket'],
         'departure_place_ticket' => $data['departure_place_ticket'],
         'arrival_place_ticket' => $data['arrival_place_ticket'],
         'iata_code_departure_ticket' => $data['iata_code_departure_ticket'],
         'iata_code_arrival_ticket' => $data['iata_code_arrival_ticket'],
         'date_departure_ticket' => $data['date_departure_ticket'],
         'date_arrival_ticket' => $data['date_arrival_ticket'],
         'time_departure_ticket' => $data['time_departure_ticket'],
         'time_arrival_ticket' => $data['time_arrival_ticket'],
         'type_flight_ticket' => 'прямой',
         'class_ticket' => $data['class_ticket'],
         'availability_luggage' => $availability_luggage,
         'price_ticket' => $data['price_ticket'],

      ]);
      return back();
      // return view('managerViews/showDetailsTicket');
      //dd($airline_ticket, $flight_ticket, $name_airplane_ticket, $iata_code_departure_ticket, $iata_code_arrival_ticket, $type_flight_ticket);
   }
   public function delete($id)
   {
      DB::table('tickets')->where('id_ticket', '=', $id)->delete();
      return back();
   }
}
