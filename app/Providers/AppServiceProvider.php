<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use DB;
use Log;
class AppServiceProvider extends ServiceProvider
{
  /**
  * Bootstrap any application services.
  *
  * @return void
  */
  public function boot()
  {
    Schema::defaultStringLength(191);

    DB::listen(function($query) {
        Log::info(
            $query->sql,
            $query->bindings,
            $query->time
        );
    });
  }

  /**
  * Register any application services.
  *
  * @return void
  */
  public function register()
  {
    /*$this->app->singleton(FakerGenerator::class, function () {
        return FakerFactory::create('pt_BR');
    });*/
  }
}
