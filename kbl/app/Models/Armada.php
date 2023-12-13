<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    use HasFactory;
    protected $table = "supirs";
    public $timestamps = false;
    public function supir()
    {
        return $this->belongsTo(Supir::class, 'id_supir', 'id');
    }
}
