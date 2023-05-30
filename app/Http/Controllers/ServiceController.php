<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
   public function show()
   {
      $services =  Service::all();
      return view('managerViews/showServices', compact('services'));
   }

   public function showForCreate()
   {
      return view('managerViews/showForCreateService');
   }
   public function create(Request $request)
   {
      $data = $request->all();

      DB::table('services')->insert([
         'name_services' => $data['name_service'],
         'availability_services' => $data['availability_service'],
         'quantity_services' => $data['quantity_service'],
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
