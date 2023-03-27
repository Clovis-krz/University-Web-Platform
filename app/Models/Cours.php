<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $table = 'cours';
    protected $primaryKey = 'id';
    public $timestamps = true;

    function user(){
        return $this->belongsToMany(User::class, 'cours_users', 'id', 'id')
            ->withPivot('cours_users') && $this->belongsTo(User::class, 'id');
    }

    function formation(){
        return $this->belongsTo(Formation::class, 'id');
    }

    function planning(){
        return $this->hasMany(Planning::class, 'id');
    }
}
