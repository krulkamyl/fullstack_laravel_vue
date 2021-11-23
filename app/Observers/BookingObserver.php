<?php

namespace App\Observers;

use App\Models\Booking;
use Faker\Factory as Faker;

class BookingObserver
{

    private $faker;

    /**
     * Contructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = Faker::create();
    }
    /**
     * Handle the Booking "creating" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function creating(Booking $booking)
    {
        $booking->review_key = $this->faker->uuid();
    }

    /**
     * Handle the Booking "updated" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function updated(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "deleted" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function deleted(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function restored(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function forceDeleted(Booking $booking)
    {
        //
    }
}
