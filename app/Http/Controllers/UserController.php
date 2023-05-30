<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
   public function updateUser($id, Request $request)
   {

      $data = $request->all();

      $filename = $data['image']->getClientOriginalName();
      $filename->move('../images', $filename);

      DB::table('users')->where('id', '=', $id)->update([
         'name' => $data['name'],
         'surname' => $data['surname'],
         'patronymic' => $data['patronymic'],
         'email' => $data['email'],
         'phone_user' => $data['phone_user']
      ]);
      return back();
   }
}
