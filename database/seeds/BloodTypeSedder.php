<?php

use App\Models\Blood_Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTypeSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('blood__types')->delete();
        $bgs = ['O+','O-','A+','A-','B+','B-','AB+','AB-'];
        foreach ($bgs as $bg){
            Blood_Type::create(['Name'=>$bg]);
        }
    }
}
