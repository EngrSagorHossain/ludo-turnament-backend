<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tournament_id',
        'payments_method',
        'transaction_id',
        'user_image',
        'user_phone',
        'user_name',
        'user_address',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
