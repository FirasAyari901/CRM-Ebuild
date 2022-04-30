<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'projet_id',
        'personnel_id',
        'titre',
        'deadline',
        'description',
        'etat'
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
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
