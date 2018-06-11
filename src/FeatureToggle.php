<?php

namespace LaravelFeatures;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FeatureToggle extends Model
{
    use TogglesValue;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feature()
    {
        return $this->belongsTo(get_class(app(Feature::class)));
    }

    /**
     * @param Builder $query
     * @param string $name
     * @param Model $model
     * @return Builder
     */
    public function scopeFeaturable($query, $model)
    {
        return $query->where('featurable_type', $model->getMorphClass())
            ->where('featurable_id', $model->getKey());
    }
}
