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
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id')
            ->withPivot('cours_users') && $this->belongsTo(User::class, 'user_id');
    }

    function formation(){
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    function planning(){
        return $this->hasMany(Planning::class, 'cours_id');
    }
}
