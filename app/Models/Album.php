<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    protected $fillable = [
        'name',
        'image',
        'release_date',
        'band_id'
    ];

    protected $casts = [
        'release_date' => 'date'
    ];

    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
