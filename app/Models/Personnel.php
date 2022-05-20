<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Personnel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'num_tel',
        'role',
        'CV',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function equipes()
    {
        return $this->belongsToMany(Equipe::class);
    }
    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }
    public function taches()
    {
        return $this->hasMany(Tache::class);
    }
    public function subtasks()
    {
        return $this->hasMany(SousTache::class);
        
    }
    public function comments()
    {
        return $this->hasMany(Commentaire::class);
    }
}
