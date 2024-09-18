<?php

namespace App\Traits;
use Faker\Factory as Faker;

trait GenerateColors
{
    public function generateColor()
    {
        $faker = Faker::create();
        return $faker->hexColor();
    }
}
