<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tache_id',
        'soustache_id',
        'personnel_id',
        'file',
        'image',
        'description',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
    public function task()
    {
        return $this->belongsTo(Tache::class);
    }
    public function subtask()
    {
        return $this->belongsTo(SousTache::class);
    }
}
