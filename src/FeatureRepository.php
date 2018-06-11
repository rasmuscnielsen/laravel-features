<?php

namespace LaravelFeatures;

use Illuminate\Database\Eloquent\Model;

class FeatureRepository
{
    /**
     * @param $name
     * @param Model $featurable
     * @return FeatureToggle
     */
    public function enableFor($name, $featurable)
    {
        return $this->getToggleOrNew($name, $featurable)->enable();
    }

    /**
     * @param $name
     * @param Model $featurable
     * @return FeatureToggle
     */
    public function disableFor($name, $featurable)
    {
        return $this->getToggleOrNew($name, $featurable)->disable();
    }

    /**
     * @param $name
     * @param Model $featurable
     * @return boolean
     */
    public function isEnabledFor($name, $featurable)
    {
        $toggle = $this->getToggleOrNew($name, $featurable);

        return $toggle->exists ? $toggle->value : $toggle->feature->value;
    }

    /**
     * @param $name
     * @param Model $featurable
     * @return FeatureToggle
     */
    protected function getToggleOrNew($name, $featurable)
    {
        return FeatureToggle::firstOrNew([
            'feature_id' => Feature::where('slug', $name)->firstOrFail()->id,
            'featurable_id' => $featurable->getKey(),
            'featurable_type' => $featurable->getMorphClass(),
        ]);
    }
}