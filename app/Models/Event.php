<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'capacity',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
