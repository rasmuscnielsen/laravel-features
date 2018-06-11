<?php

namespace LaravelFeatures\Tests;

use Faker\Generator;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use LaravelFeatures\FeatureToggle;
use LaravelFeatures\Feature;
use LaravelFeatures\Tests\Stubs\Job;
use LaravelFeatures\Tests\Stubs\User;

trait ModelFactory
{
    /**
     * @param Application $app
     */
    protected function registerFactories(Application $app)
    {
        $factory = $app->make(\Illuminate\Database\Eloquent\Factory::class);
        $factory->define(Feature::class, function (Generator $faker) {
            return [
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
            ];
        });
    }

    /**
     * @return Job
     */
    protected function job()
    {
        return Job::create([]);
    }

    /**
     * @param $category
     * @param int $value
     * @return mixed
     */
    protected function rating($value, $category)
    {
        return new FeatureToggle([
            'rating_category_slug' => $category instanceof RatingCategory ? $category->slug : $category,
            'value' => $value,
        ]);
    }

    /**
     * @param $slug
     * @param int $weight
     * @return RatingCategory
     */
    protected function ratingCategory($weight, $slug = null)
    {
        return RatingCategory::create([
            'slug' => ($slug = $slug ?: app(Generator::class)->slug),
            'name' => Str::title($slug),
            'weight' => $weight,
        ]);
    }

    /**
     * @return Feature
     */
    protected function review()
    {
        $review = factory(Feature::class)->make();
        $review->reviewee()->associate($this->user());
        $review->reviewer()->associate($this->user());
        $review->reviewable()->associate($this->job());

        return tap($review)->save();
    }

    /**
     * @param array $attributes
     * @return User
     */
    protected function user($attributes = [])
    {
        return User::create(factory(\App\User::class)->make($attributes)->getAttributes());
    }
}
