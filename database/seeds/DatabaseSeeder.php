<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => "Admin",
            'username' => "admin",
            'role' => "admin",
            'password' => Hash::make('123456'),
        ]);
        
        // factory(App\Client::class, 10)->create();
        // factory(App\Produit::class, 10)->create();
        factory(App\Client::class, 500)->create()->each(function ($client) {
        $client->produits()->save(factory(App\Produit::class)->make());
        $client->produits()->save(factory(App\Produit::class)->make());
        $client->produits()->save(factory(App\Produit::class)->make());
        $client->produits()->save(factory(App\Produit::class)->make());
        $client->produits()->save(factory(App\Produit::class)->make());
    });
    }
}
