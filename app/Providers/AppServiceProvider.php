<?php

namespace App\Providers;

use App\Models\Frontend\CartModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $settings = DB::table("settings")->get();

        $config = [];
        foreach($settings as $setting) {
            $config[$setting->name] = $setting->value;
        }

        view()->share('config', $config);
    }
}
