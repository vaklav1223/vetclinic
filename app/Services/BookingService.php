<?php

namespace App\Services;

use App\Models\Booking;
use App\Contracts\SmsSender;
use Illuminate\Validation\ValidationException;

class BookingService
{
    protected SmsSender $smsSender;

    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    public function createBooking(array $data): Booking
    {
        $activeBookingsCount = Booking::where('pet_id', $data['pet_id'])
            ->where('status', 'new')
            ->count();

        if ($activeBookingsCount >= 3) {
            throw ValidationException::withMessages([
                'pet_id' => ['Для этого питомца уже есть 3 активные заявки на рассмотрении.'],
            ]);
        }

        $booking = Booking::create($data);

        $this->smsSender->send($booking->phone, "Ваша заявка на приём питомца успешно создана!");

        return $booking;
    }
}
