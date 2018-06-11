<?php

namespace LaravelFeatures;

trait TogglesValue
{
    /**
     * @var array
     */
    protected $casts = [
        'value' => 'int',
    ];

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