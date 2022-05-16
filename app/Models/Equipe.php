<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pseudo'
    ];

    public function personnels()
    {
        return $this->belongsToMany(Personnel::class);
    }

    public function projects()
    {
        return $this->hasMany(Projet::class);
    }

}
