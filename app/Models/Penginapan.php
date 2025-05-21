<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $fillable = ['nama', 'alamat', 'gambar_url', 'public_id'];

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }
}
