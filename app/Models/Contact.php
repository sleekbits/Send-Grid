<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','email','phone','company','tag','status','source','country','notes','consent_at','double_opt_in_at'];

    protected function casts(): array
    {
        return ['consent_at' => 'datetime', 'double_opt_in_at' => 'datetime'];
    }
}
