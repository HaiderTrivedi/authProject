<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'user_id', 'receipt_no', 'receipt_date', 'name', 'its_number', 'currency_id',
        'kh', 'nm', 'khms', 'si', 'mnt', 'nyz', 'nj', 
        'total_collection', 'payment_mode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cheques()
    {
        return $this->hasMany(Cheque::class);
    }
}
