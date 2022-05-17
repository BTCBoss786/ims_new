<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('states')->insert([
         ['name' => 'Jammu and Kashmir', 'code' => '01'],
         ['name' => 'Himachal Pradesh', 'code' => '02'],
         ['name' => 'Punjab', 'code' => '03'],
         ['name' => 'Chandigarh', 'code' => '04'],
         ['name' => 'Uttarakhand', 'code' => '05'],
         ['name' => 'Haryana', 'code' => '06'],
         ['name' => 'Delhi', 'code' => '07'],
         ['name' => 'Rajasthan', 'code' => '08'],
         ['name' => 'Uttar Pradesh', 'code' => '09'],
         ['name' => 'Bihar', 'code' => '10'],
         ['name' => 'Sikkim', 'code' => '11'],
         ['name' => 'Arunachal Pradesh', 'code' => '12'],
         ['name' => 'Nagaland', 'code' => '13'],
         ['name' => 'Manipur', 'code' => '14'],
         ['name' => 'Mizoram', 'code' => '15'],
         ['name' => 'Tripura', 'code' => '16'],
         ['name' => 'Meghalaya', 'code' => '17'],
         ['name' => 'Assam', 'code' => '18'],
         ['name' => 'West Bengal', 'code' => '19'],
         ['name' => 'Jharkhand', 'code' => '20'],
         ['name' => 'Odisha', 'code' => '21'],
         ['name' => 'Chattisgarh', 'code' => '22'],
         ['name' => 'Madhya Pradesh', 'code' => '23'],
         ['name' => 'Gujarat', 'code' => '24'],
         ['name' => 'Dadra and Nagar Haveli and Daman and Diu', 'code' => '26'],
         ['name' => 'Maharashtra', 'code' => '27'],
         ['name' => 'Andhra Pradesh', 'code' => '28'],
         ['name' => 'Karnataka', 'code' => '29'],
         ['name' => 'Goa', 'code' => '30'],
         ['name' => 'Lakshadweep', 'code' => '31'],
         ['name' => 'Kerala', 'code' => '32'],
         ['name' => 'Tamil Nadu', 'code' => '33'],
         ['name' => 'Puducherry', 'code' => '34'],
         ['name' => 'Andaman and Nicobar Islands', 'code' => '35'],
         ['name' => 'Telangana', 'code' => '36'],
         ['name' => 'Andhra Pradesh', 'code' => '37'],
      ]);
   }

}
