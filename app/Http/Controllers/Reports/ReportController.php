<?php

namespace App\Http\Controllers\Reports;
use App\Booking;
use App\Bus;
use App\Http\Controllers\Controller;
use App\User;


class ReportController extends Controller
{

    protected $bus;

    protected $booking;

    protected $user;

    /**
     * ReportController constructor.
     * @param User $user
     * @param Booking $booking
     * * @param Bus $bus
     */
    public function __construct(Bus $bus,Booking $booking,\App\User $user)
    {
        $this->bus = $bus;
        $this->booking = $booking;
        $this->user= $user;
    }

    public function booking()
    {
        $bookings = $this->booking->whereHas('user')->whereHas('bus')->paginate(15);

        return view('reports.booking')->with('bookings', $bookings);
    }

    public function bus()
    {
        $buses = $this->bus->whereHas('booking')->paginate(15);

        return view('reports.bus')->with('buses', $buses);
    }

}
