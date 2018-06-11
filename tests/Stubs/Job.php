<?php

namespace LaravelFeatures\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use LaravelFeatures\Featurable;

class Job extends Model
{
    use Featurable;
}
