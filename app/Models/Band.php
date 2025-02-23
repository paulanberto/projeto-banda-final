<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Band extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];


    public function albuns()
    {
        return $this->hasMany(Album::class);
    }
}
