<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


$factory->define(App\Model\Pemesanan::class, function (faker $faker) {
    $date = new DateTime();
    $date->setDate(2024, 4, 11);
    return [
        'no_faktur' => "p".sprintf('%08d',$faker->unique()->numberBetween(1,99999999)),
        'tgl_faktur' =>$date->format('Y-m-d'),
        'pelanggan_id' => 1,
        'user_id' => 1
    ];
});

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pemesanan>
 */
class PemesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
