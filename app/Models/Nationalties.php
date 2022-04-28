<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;


use Illuminate\Database\Eloquent\Model;

class Nationalties extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable = ['Name'];
}
