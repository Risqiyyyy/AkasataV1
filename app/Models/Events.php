<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Events extends Model
{
    use HasFactory, Searchable;

    public $fillable = ['title', 'hostname', 'tags', 'dst', 'src', 'uuid','date_time','image','deskripsi'];
    public $timestamps = true;

    protected $guarded = [];

    public function searchableAs()
    {
        return 'endpoint';
    }

    public function toSearchableArray()
    {
        return [
            'title'     => $this->title,
            'hostname'     => $this->hostname,
            'uuid'     => $this->uuid,
        ];
    }

}
