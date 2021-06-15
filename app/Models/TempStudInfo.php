<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempStudInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'lname', 'fname', 'mname', 'addb', 'addt', 'addp', 'gender',
        'bdate', 'status', 'father', 'mother', 'foccup', 'moccup',
        'addparents'
    ];

    public function user() {
        return $this->hasOne('App\Models\User');
    }
}
