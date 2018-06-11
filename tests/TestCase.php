<?php

namespace LaravelFeatures\Tests;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use LaravelFeatures\FeaturesServiceProvider;
use Schema;

class TestCase extends BaseTestCase
{
//    use ModelFactory;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('APP_ENV=testing');
        putenv('APP_DEBUG=true');
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE=:memory:');

        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        $app->useEnvironmentPath(__DIR__.'/..');
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $app->register(FeaturesServiceProvider::class);
        $app->afterResolving('migrator', function (Migrator $migrator) {
            $migrator->path(__DIR__.'/migrations/');
        });

//        $this->registerFactories($app);

        return $app;
    }
}
