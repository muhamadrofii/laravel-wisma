<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Penginapan;




class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kamar',
        'gambar_url',
        'public_id',
        'ac',
        'wifi',
        'televisi',
        'penjemputan',
        'status',
        'tipe_kelas',
        'penginapan_id',
    ];

    public function penginapan()
    {
        return $this->belongsTo(Penginapan::class);
    }
}
