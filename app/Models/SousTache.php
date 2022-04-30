<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousTache extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tache_id',
        'personnel_id',
        'titre',
        'deadline',
        'description',
        'etat'
    ];

    public function task()
    {
        return $this->belongsTo(Tache::class);
    }
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
    public function comments()
    {
        return $this->hasMany(Commentaire::class);
    }

    
}
