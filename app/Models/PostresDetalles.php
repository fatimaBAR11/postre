<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostresDetalles extends Model
{
    use HasFactory;

    protected $fillable = ['postre_id', 'ingrediente_id'];

    public function ingrediente()
    {
        return $this->belongsTo(Ingredientes::class, 'ingrediente_id');
    }

    public function postre()
    {
        return $this->belongsTo(Postres::class, 'postre_id');
    }
}
