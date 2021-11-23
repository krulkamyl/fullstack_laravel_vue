<?php

namespace App\Models;

use App\Models\Factory\UuidFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Review extends UuidFactory
{
    use HasFactory;

    protected $fillable = [
        'id',
        'content',
        'rating'
    ]; 

    protected $table = 'reviews';

    public function bookable() 
    {
        return $this->belongsTo(Review::class);
    }

    public function booking() 
    {
        return $this->belongsTo(Booking::class);
    }

}
