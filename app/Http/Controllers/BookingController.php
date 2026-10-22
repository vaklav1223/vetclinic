<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use App\Events\BookingCreated; 
use App\Jobs\RemindAboutBooking;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking');
    }

    public function store(StoreBookingRequest $request, BookingService $bookingService)
    {
        $fullComment = "Питомец: " . $request->pet_name . " (Порода: " . $request->pet_breed . ").";
        if ($request->comment) {
            $fullComment .= " Комментарий: " . $request->comment;
        }

        $data = [
            'user_id' => auth()->id(),
            'pet_id' => 2, 
            'phone' => $request->phone,
            'comment' => $fullComment,
            'status' => 'new',
        ];

        $booking = $bookingService->createBooking($data);

        BookingCreated::dispatch($booking);

        RemindAboutBooking::dispatch($booking)->delay(now()->addMinutes(2));

        return redirect()->route('profile')->with('success', "Заявка №{$booking->id} отправлена");
    }
}
