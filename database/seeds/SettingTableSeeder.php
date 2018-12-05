<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $setting = new Setting([
      [
        "name" => "app.name",
        "value" => "Laravel"
      ]
    ]);

    $setting->save();

  }
}
