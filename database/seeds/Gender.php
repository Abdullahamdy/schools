<?php

use App\Models\Gender as ModelsGender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Gender extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $gender = [
           ['en'=>'Male', 'ar'=>'ذكر'],
           ['en'=>'Female','ar'=>'أنثي'],
        ];
        foreach($gender as $ge){
            ModelsGender::create(['Name'=>$ge]);

        }
    }
}
