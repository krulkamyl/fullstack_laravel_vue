<?php

namespace App\Models;

use App\Models\Bookable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'from' => 'datetime:Y-m-d',
        'to' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s'
    ];

    protected $fillable = [
        'from', 
        'to'
    ];
    
    public function bookable() 
    {        
        return $this->belongsTo(Bookable::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function scopeBetweenDates(Builder $query, $from, $to) 
    {
        return $query->where('to', '>', $from)
                ->where('from', '<=', $to);
                
    }

    public static function findByReviewKey(string $reviewKey): ?Booking 
    {
        return static::where('review_key', $reviewKey)->with('bookable')->get()->first();        
    }
}
