<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use App\Mail\BookingCreatedMail;
use App\Notifications\NewBooking;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
            'pet_id' => 1, 
            'phone' => $request->phone,
            'comment' => $fullComment,
            'status' => 'new',
        ];

        $booking = $bookingService->createBooking($data);

        Mail::to(auth()->user()->email)->send(new BookingCreatedMail($booking));

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewBooking($booking));

        return redirect()->route('profile')->with('success', "Заявка №{$booking->id} отправлена");
    }
}
