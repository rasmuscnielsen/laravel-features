<?php

namespace LaravelFeatures;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FeatureToggle extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'value' => 'int',
    ];

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

    /**
     * @param null $value
     * @return $this
     */
    public function toggle($value = null)
    {
        return tap($this->fill(['value' => $value ?? ! $this->value])->save());
    }

    /**
     * @return $this
     */
    public function enable()
    {
        return tap($this->fill(['value' => 1])->save());
    }

    /**
     * @return $this
     */
    public function disable()
    {
        return tap($this->fill(['value' => 0])->save());
    }
}
