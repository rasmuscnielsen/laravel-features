<?php

namespace LaravelFeatures;

use Illuminate\Support\ServiceProvider;

class FeaturesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! class_exists('CreateFeaturesTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_features_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_features_table.php'),
                __DIR__.'/../database/migrations/create_feature_toggles_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_feature_toggles_table.php'),
            ], 'migrations');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
