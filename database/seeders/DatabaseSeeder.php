<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (City::all()->count() === 0) {
            $this->call(CitySeeder::class);
        }

        $user = User::firstOrCreate([
            'email' => 'maycon@creattion.com.br',
        ], [
            'name' => 'Maycon',
            'email' => 'maycon@creattion.com.br',
            'password' => bcrypt('password'),
        ]);

        $company = Company::firstOrCreate([
            'id' => 1,
        ], [
            'city_id' => 1,
            'user_id' => $user->id,
            'name' => 'Creattion',
        ]);

        $user->companies()->attach($company->id);
    }
}
