<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Endpoint extends Model
{
    use HasFactory, Searchable;

    public $fillable = ['hostname', 'regional', 'ip'];
    public $timestamps = true;

    protected $guarded = [];

    public function searchableAs()
    {
        return 'endpoint';
    }

    public function toSearchableArray()
    {
        return [
            'hostname'     => $this->hostname,
            'regional'     => $this->regional,
            'ip'     => $this->ip,
        ];
    }

    public static $rules = [
        'hostname' => 'required|unique:endpoints,hostname',
        'ip' => 'required|unique:endpoints,ip',
    ];
}
