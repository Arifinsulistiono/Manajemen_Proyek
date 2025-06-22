<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'status',
    ];

    public function reseps()
    {
        return $this->belongsToMany(Resep::class);
    }
}
