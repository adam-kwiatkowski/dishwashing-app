<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EventTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(): void
  {
    Schema::disableForeignKeyConstraints();
    DB::table('event_types')->truncate();
    DB::table('event_types')->insert([
      ['name' => 'used'],
      ['name' => 'washed'],
    ]);
    Schema::enableForeignKeyConstraints();
  }
}
