<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPets extends Command
{
    protected $signature = 'pets:import {file}';
    protected $description = 'Импорт питомцев из CSV-файла';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("Файл не найден: {$filePath}");
            return 1;
        }

        if (($handle = fopen($filePath, 'r')) === false) {
            $this->error("Не удалось открыть файл: {$filePath}");
            return 1;
        }

        $added = 0;
        $skipped = 0;
        $rowNumber = 0;

        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            if (count($data) == 1 && str_contains($data[0], ',')) {
                $data = str_getcsv($data[0], ',');
            }

            $rowNumber++;

            if (count($data) < 4) {
                $this->warn("Строка {$rowNumber}: Ошибка формата (недостаточно колонок).");
                $skipped++;
                continue;
            }

            $name = trim($data[0]);
            $ownerId = trim($data[3]);

            if (empty($name) || empty($ownerId) || !is_numeric($ownerId)) {
                $this->warn("Строка {$rowNumber}: Неверные данные (пустое имя или некорректный id Владельца).");
                $skipped++;
                continue;
            }

            try {
                $added++;
            } catch (\Exception $e) {
                $this->warn("Строка {$rowNumber}: Ошибка при сохранении в базу данных.");
                $skipped++;
            }
        }

        fclose($handle);

        $this->info("Итог: добавлено {$added}, пропущено {$skipped}.");
        return 0;
    }
}
