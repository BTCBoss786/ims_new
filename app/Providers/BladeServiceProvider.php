<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($amt) {
            return "<?php echo '&#8377; ' . number_format($amt, 2); ?>";
        });

        Blade::directive('spell', function ($amt) {
            return "<?php echo '&#8377; ' . number_format($amt, 2); ?>";
        });
    }

}
