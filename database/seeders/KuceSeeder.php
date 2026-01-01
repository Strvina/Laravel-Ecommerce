<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kuce;


class KuceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Kuce::create([
            'name' => 'Rex',
            'breed' => 'German Shepherd',
            'price' => 1200,
            'description' => 'Strong and loyal dog',
            'image' => 'srecko.jpeg',
        ]);

        Kuce::create([
            'name' => 'Bella',
            'breed' => 'Labrador',
            'price' => 1000,
            'description' => 'Friendly and smart dog',
            'image' => 'srecko.jpeg',
        ]);

        Kuce::create([
            'name' => 'Max',
            'breed' => 'Bulldog',
            'price' => 900,
            'description' => 'Calm and strong dog',
            'image' => 'srecko.jpeg',
        ]);

        Kuce::create([
            'name' => 'Luna',
            'breed' => 'Poodle',
            'price' => 1100,
            'description' => 'Elegant and intelligent dog',
            'image' => 'srecko.jpeg',
        ]);

        Kuce::create([
            'name' => 'Charlie',
            'breed' => 'Beagle',
            'price' => 950,
            'description' => 'Playful and curious dog',
            'image' => 'srecko.jpeg',
        ]); //

        Kuce::create([
            'name' => 'Mladen',
            'breed' => 'Zoljin',
            'price' => 1,
            'description' => 'Favorit food: kuretina',
            'image' => 'srecko.jpeg',
        ]); //

        Kuce::create([
            'name' => 'Anastasija',
            'breed' => 'sunjalica',
            'price' => 1,
            'description' => 'Trci za Nikolu',
            'image' => 'srecko.jpeg',
        ]);

        Kuce::create([
            'name' => 'Miroslav',
            'breed' => 'pecenjevacki staford',
            'price' => 1,
            'description' => 'Voli da ga devojka vrze na lanac',
            'image' => 'srecko.jpeg',
        ]);

        Kuce::create([
            'name' => 'Vladimir',
            'breed' => 'cekminska zivotinja',
            'price' => 1,
            'description' => 'Tuguje za zenku koju nije ni imao',
            'image' => 'srecko.jpeg',
        ]);

        Kuce::create([
            'name' => 'Luna',
            'breed' => 'Poodle',
            'price' => 1100,
            'description' => 'Elegant and intelligent dog',
            'image' => 'srecko.jpeg',
        ]);
        Kuce::create([
            'name' => 'Luna',
            'breed' => 'Poodle',
            'price' => 1100,
            'description' => 'Elegant and intelligent dog',
            'image' => 'srecko.jpeg',
        ]);

    }
}
