<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadRdp extends Model
{
    use HasFactory;
    
    protected $fillable = ['json_rdp'];
}
