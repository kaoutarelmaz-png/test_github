<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompterUserModel extends Model
{
    protected $fillable=['firstName','lastName','email','password'];
    protected $table='computeruser';
}
