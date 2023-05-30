<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   public function getAllUsers()
   {
      $users = User::all();
      //dd($users);
      return view('adminViews/userList', compact('users'));
   }

   public function getUserDetails($id)

   {
      $userdetail = new User;
      return view('adminViews/userDetails', ['data' => $userdetail->find($id)]);
   }

   public function getAllOrders()
   {
   }

   public function createManager($id)
   {
      DB::table('users')->where('id', '=', $id)->update([
         'type_user' => 'менеджер'
      ]);
      return back();
   }
   public function deleteManager($id)
   {
      DB::table('users')->where('id', '=', $id)->update([
         'type_user' => 'клиент'
      ]);
      return back();
   }
}
