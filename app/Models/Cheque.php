<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    protected $fillable = [
        'submission_id', 'payee_name', 'payer_name', 'date', 'amount', 
        'currency_id', 'cheque_number'
    ];
}
