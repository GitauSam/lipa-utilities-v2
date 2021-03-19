<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;

    protected $fillable = [
        'utility_name',
        'status'
    ];

    public function utilityPaymentMethods()
    {

        return $this->hasMany(UtilityPaymentMethod::class);
        
    }

}
