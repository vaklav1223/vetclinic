<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBooking; // Или используйте Log::info для теста, если хотите

class RemindAboutBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Принимаем бронирование в конструктор
    public function __construct(protected Booking $booking)
    {
    }

    public function handle(): void
    {
        // Свежие данные из базы на случай, если статус изменился за 2 минуты
        $this->booking->refresh();

        // Проверяем: если статус всё еще 'new' (или пустой/исходный, проверьте ваше точное значение в БД)
        if ($this->booking->status === 'new' || empty($this->booking->status)) {
            
            // Находим администраторов
            $admins = User::where('is_admin', true)->get();

            // Отправляем уведомление/напоминание
            if ($admins->isNotEmpty()) {
                Notification::send($admins, new NewBooking($this->booking));
            }
            
            // Также запишем в лог для надежности проверки
            \Illuminate\Support\Facades\Log::info("Заявка №{$this->booking->id} ждёт больше 2 минут.");
        }
    }
}
