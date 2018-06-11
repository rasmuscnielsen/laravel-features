<?php

namespace Makeable\LaravelEscrow;

use Illuminate\Support\Facades\Facade;
use LaravelFeatures\FeatureRepository;

class Feature extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return FeatureRepository::class;
    }
}
