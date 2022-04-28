<?php

use App\Models\Specailization as ModelsSpecailization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Specailization extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specailizations')->delete();
        $specailizations = [
             ['en'=>'Arabic','ar'=>'عربي'],
             ['en'=>'Science','ar'=>'علوم'],
             ['en'=>'Computer','ar'=>'حاسب ألي'],
             ['en'=>'English','ar'=>'أنجليزي']


        ];
        foreach ($specailizations as $spec){
            ModelsSpecailization::create([
                'Name'=>$spec]);
        }

    }
}
