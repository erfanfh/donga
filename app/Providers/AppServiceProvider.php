<?php

namespace App\Providers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Forbid user from make payment from and to itself
        Gate::define('make-self-payment', function (User $user, Person $person, Request $request) {
            return $person->id != $request->creditor;
        });

        //Forbid user from make payment if it is not debtor
        Gate::define('make-payment', function (User $user, Person $person) {
            return $person->balance < 0;
        });

        //Forbid user from be destroyed if it is debator
        Gate::define('delete-person', function (User $user, Person $person) {
            return $person->balance == 0;
        });
    }
}
