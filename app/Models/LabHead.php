<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nip',
        'is_active',
    ];
}
