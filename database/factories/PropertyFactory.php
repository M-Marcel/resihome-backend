<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Property;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// BUY
// 'Home for sale';
// 'New home';
// 'For sale by owner';

// RENT
// 'Long term lease';
// 'Short term lease';

// 'status' => 'sold',

// factory(App\Property::class, 5)->create();

$factory->define(Property::class, function (Faker $faker){
    return [



        'agent_id' => 1,
        'category' => 'New home',
        'address' => $faker->address,
        'location' => 'Houston',
        'description' => $faker->text,
        'type' => 'Single Family',
        'sub_type' => 'other',
        'home_type' => 'other',
        'status' => 1,
        'bedroom' =>4,
        'bathroom' =>4,
        'half_bedroom' =>2,
        'quarter_bedroom' =>1,
        'three_quarter_bedroom' =>1,
        'size' =>'9000',
        'main_prize' =>'6300000',
        'estimate_prize' =>'7000000',
        'year_built' => '2019',
        'heating' => 'Other',
        'cooling' => 'Other',
        'parking' => '2',
        'lot_size' => '1.5',
        'story' => 1,
        'internet_tv' => 'Other',
        'new_construction' => 'Other',
        'major_remodel_year' => 'Other',
        'tax_value' => '320900',
        'annual_tax_amount' => '920900',
        'neighborhood' =>'other',
        'transport' =>1,
        'shopping' =>1,
        'school' =>1,
        'swimmimg_pool' => 1,
        'gym' => 1,
        'city' => 1,
        'water' => 1,
        'park' => 1,
        'cordinate' => '12 LAT 1.4 NW',
    ];
});
