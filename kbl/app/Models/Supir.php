<?php

namespace App\Models;

use App\Models\City;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supir extends Model
{
    use HasFactory;
    protected $table = "supirs";
    public $timestamps = false;
    public function province(){
        return $this->belongsTo(Province::class,'province_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function subdistrict(){
        return $this->belongsTo(Subdistrict::class,'subdistrict_id','id');
    }
}
