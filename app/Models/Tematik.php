<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tematik extends Model
{
    use HasFactory;

    protected $table = 'tb_tematik';

    protected $fillable = ['tematik'];

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class, Tematik::class);
    }
}
