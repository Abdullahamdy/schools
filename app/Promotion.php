<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];

    public function Student(){
        return $this->belongsTo('App\Models\Student','student_id');
    }
    public function Grade(){
        return $this->belongsTo('App\Models\Grade','from_grade');
    }
    public function Classroom(){
        return $this->belongsTo('App\Models\Classroom','from_Classroom');
    }
    public function Section(){
        return $this->belongsTo('App\Models\Section','from_section');
    }


    ////////to///////////////////

    public function to_Grade(){
        return $this->belongsTo('App\Models\Grade','to_grade');
    }
    public function to_classroom(){
        return $this->belongsTo('App\Models\Classroom','to_Classroom');
    }
    public function to_Section(){
        return $this->belongsTo('App\Models\Section','to_section');
    }
}
