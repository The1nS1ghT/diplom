<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
   /**
    * The model to policy mappings for the application.
    *
    * @var array<class-string, class-string>
    */
   protected $policies = [
      //
   ];

   /**
    * Register any authentication / authorization services.
    */
   public function boot(): void
   {

      VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
         return (new MailMessage)
            ->subject('Verify Email Address')
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email Address', $url);
      });

      Gate::define('view-protected-admin', function (User $user) {
         return  $user->type_user == 'администратор';
      });

      Gate::define('view-protected-manager', function (User $user) {
         return  $user->type_user == 'менеджер';
      });
   }
}
