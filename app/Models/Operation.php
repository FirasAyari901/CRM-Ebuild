<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document_id',
        'nature_operation',
        'montant_HT',
        'montant_TVA'
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
