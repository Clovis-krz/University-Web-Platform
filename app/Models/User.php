<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getAuthPassword(){
        return $this->mdp;
    }

    function cours(){
        return $this->belongsToMany(Cours::class, 'cours_users', 'user_id', 'cours_id')
            ->withPivot('user_id');
    }

    function enseigne()
    {
        return $this->hasMany(Cours::class, 'user_id');
    }

    function formation(){
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function IsVerified(){
        return $this->type != 'null';
    }

    public function IsAdmin(){
        return $this->type == 'admin';
    }

    public function IsStudent(){
        return $this->type == 'etudiant';
    }

    public function IsTeacher(){
        return $this->type == 'enseignant';
    }

    protected $attributes = [ 'type' => 'null' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'login',
        'mdp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mdp',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
