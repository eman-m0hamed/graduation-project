<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class symptom_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'et_1',
        'et_2',
        'et_3',
        'et_4',
        'et_5',
        'et_6',
        'user_id',
    ];

    public function User(){
        return $this->belongsToMany('App\Models\User');
    }

    // public function doctor(){
    //     return $this->belongsToMany('App\Models\doctor');
    // }
}
