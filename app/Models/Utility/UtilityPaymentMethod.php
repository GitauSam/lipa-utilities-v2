<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityPaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        "utility_id",
        "payment_method_name",
        "lipa_na_mpesa_paybill",
        "status"
    ];
    
}
