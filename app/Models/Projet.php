<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',
        'equipe_id',
        'project_name',
        'description',
        'deadline',
        'date_debut',
        'etat',
        'file_cdc',
        'capture_dc'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

}
