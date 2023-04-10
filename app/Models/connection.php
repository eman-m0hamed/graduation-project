<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connection extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'user_id',

    ];

    public function User(){
        return $this->belongsToMany('App\Models\User');
    }

}
