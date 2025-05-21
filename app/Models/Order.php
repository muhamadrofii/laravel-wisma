<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Kamar;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    // Menentukan bahwa kolom primary key menggunakan UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'no_transaction', 'external_id', 'item_name', 'qty', 'price', 'grand_total', 'invoice_url', 'status', 
        'jumlah_hari',
        'checkin',
        'checkout',

        'jatuh_tempo',

        'name',
        'email',
        'no_telp',
        'user_id'	,
        'kamar_id',	
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    // Menggunakan UUID untuk primary key
    protected static function booted()
    {
        static::creating(function ($order) {
            if (!$order->id) {
                $order->id = (string) Str::uuid(); // Generate UUID jika id belum ada
            }
        });
    }
}

