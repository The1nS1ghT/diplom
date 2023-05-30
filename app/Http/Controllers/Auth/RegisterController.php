<?php

namespace App\Http\Controllers\Auth;


use App\Mail\UserRegistered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class RegisterController extends Controller
{

   /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   use RegistersUsers;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = RouteServiceProvider::HOME;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('guest');
   }

   public function confirmEmail(Request $request, $token)
   {
      User::whereToken($token)->firstOrFail()->confirmEmail();
      $request->Session::flash('message', 'Учетная запись подтверждена. Войдите под своим именем.');
      return redirect('login');
   }
   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'name' => ['required', 'string', 'max:255'],
         'surname' => ['required', 'string', 'max:255'],
         'patronymic' => ['nullable', 'string', 'max:255'],
         'phone_user' => ['required', 'string', 'max:11'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['required', 'string', 'min:3', 'confirmed'],
         'type_user' => ['required', 'string'],
         'blocked' => ['required', 'string']
      ]);
   }
   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\Models\User
    */
   protected function create(array $data)
   {
      return User::create([
         'name' => $data['name'],
         'surname' => $data['surname'],
         'patronymic' => $data['patronymic'],
         'phone_user' => $data['phone_user'],
         'email' => $data['email'],
         'password' => Hash::make($data['password']),
         'type_user' => $data['type_user'],
         'blocked' => $data['blocked']
      ]);
   }
}
