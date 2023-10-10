<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    public $fillable = ['title', 'hostname', 'tags', 'dst', 'src', 'uuid','date_time','image','deskripsi'];
    public $timestamps = true;

}
