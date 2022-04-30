<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',
        'personnel_id',
        'titre',
        'description',
        'file',
        'image'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
