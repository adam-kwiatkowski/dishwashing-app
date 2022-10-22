<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Utensil;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run(): void
  {
    User::factory(10)->create();
    Utensil::factory(15)->create();

    DB::table('users')->insert([
      'name' => 'Test User',
      'email' => 'test@example.com',
      'password' => '$2y$10$PeHdndzKdOyrRWQhhHNFNeTydD4ySaMD6vtIs9hva4I3txTg/sJP6',
    ]);

    $this->call(EventTypeSeeder::class);
  }
}
