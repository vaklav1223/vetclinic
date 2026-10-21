<?php

namespace App\Services;

use App\Contracts\SmsSender;

class NullSmsSender implements SmsSender
{
    public function send(string $phone, string $message): void
    {
        // Ничего не делаем
    }
}
