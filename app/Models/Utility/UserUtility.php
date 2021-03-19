<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUtility extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'utility_id',
        'kenya_power_meter_number',
        'status'
    ];

    public function utility()
    {

        return $this->belongsTo('App\Models\Utility\Utility', 'utility_id');
        
    }
}
