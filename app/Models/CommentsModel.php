<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model
{
    protected $fillable=['name','email','messager'];
    protected $table='commants';
}
