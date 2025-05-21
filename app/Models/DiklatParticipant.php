<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DiklatParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'diklat_name', 'institution', 'start_date', 'end_date'
    ];

    // Relasi Many-to-One ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
