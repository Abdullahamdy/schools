<?php

use App\Models\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->delete();
        $religions = [
            [
                'en'=>'Muslim',
                'ar'=>'مسلم'
            ],
            [
                'en'=>'Christion',
                'ar'=>'مسيحي'
            ],
            [
                'en'=>'other',
                'ar'=>'غير ذلك'
            ]

        ];
        foreach($religions as $reglion){
           Religion::create(['Name'=>$reglion]);

        }
    }
}
