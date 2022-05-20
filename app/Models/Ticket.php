<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'projet_id',
        'titre',
        'description',
        'file'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function projet()
    {
        return $this->hasOne(Projet::class);
    }
    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }
    
}
