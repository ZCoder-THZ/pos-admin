<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $client = new Client();
        $faker = Faker::create();

        foreach(range(1,12) as $index) {
            $response = $client->get('https://api.unsplash.com/photos/random', [
                'query' => [
                    'client_id' => '6lDmzKh6A51TeV537nS65LF3HIR9CtGTGATfqkR0LS8',
                    'orientation' => 'landscape',
                    'count' => 12,
                ]
            ]);
            $imageData = json_decode($response->getBody(), true);
            $imageUrl = $imageData[0]['urls']['regular'];

            Product::create([
                'product_name' => $faker->name,
                'product_brand' => $faker->company,
                'product_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
                'product_description' => $faker->sentence,
                'category_id' => $faker->numberBetween($min = 1, $max = 10),
                'product_image' => $imageUrl,
            ]);
        }
    }
}

