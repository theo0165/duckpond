<?php

namespace App\Providers;

use App\Faker\CommunityProvider;
use Faker\{Factory, Generator};
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new CommunityProvider($faker));
            return $faker;
        });
    }
}
