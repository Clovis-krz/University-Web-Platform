<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $table = 'formations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    function user(){
        return $this->hasMany(User::class, 'id');
    }

    function cours(){
        return $this->hasMany(Cours::class, 'id');
    }
}
