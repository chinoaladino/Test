<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perrito extends Model
{
    use HasFactory;

    protected $fillable=[
      'nombre',
      'color',
      'raza_id'  
    ];


    public function Razas(){
        return $this->belongsTo(Razas::class);
    }
}
