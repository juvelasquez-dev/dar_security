<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arbo extends Model
{
    protected $fillable = [
        'office_id',
        'arbo_name',
        'acronym',
        'registration_number',
        'province',
        'municipality',
        'barangay',
        'contact_person',
        'contact_number',
        'status',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}