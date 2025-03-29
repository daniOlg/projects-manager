<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasUuids;
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'start_date',
        'status',
        'responsible',
        'amount',
    ];

    public $timestamps = true;
}
