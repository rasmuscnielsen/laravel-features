<?php

namespace LaravelFeatures\Tests\Stubs;

use Illuminate\Database\Eloquent\Builder;

class User extends \App\User
{
    /**
     * @var array
     */
    protected $guarded = [];
}
