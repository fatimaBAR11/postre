<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postres extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen', 'preparacion'];

    public function postreDetalles()
    {
        return $this->hasMany(PostresDetalles::class, 'postre_id');
    }
}
