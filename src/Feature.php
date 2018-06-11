<?php

namespace LaravelFeatures;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use SoftDeletes,
        TogglesValue;

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
     * @param $slug
     * @return $this
     */
    public static function fromSlug($slug)
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toggles()
    {
        return $this->hasMany(get_class(app(FeatureToggle::class)));
    }
}
