<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razas extends Model
{
    use HasFactory;

    protected $fillable= [
        'nombreRaza'
    ];


    public function perritos(){
        return $this->hasMany(Perrito::class);
    }

}
