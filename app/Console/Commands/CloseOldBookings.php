<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CloseOldBookings extends Command
{
    protected $signature = 'bookings:close {--days=7} {--dry-run}';
    protected $description = 'Закрытие устаревших заявок';

    public function handle()
    {
        $days = (int) $this->option('days');
        $dryRun = $this->option('dry-run');
        $dateLimit = Carbon::now()->subDays($days);

        $query = DB::table('bookings')
            ->where('created_at', '<', $dateLimit)
            ->where('status', '!=', 'closed');

        $count = $query->count();

        if ($count === 0) {
            $this->info("Устаревших заявок (старше {$days} дней) не найдено.");
            return 0;
        }

        if ($dryRun) {
            $this->info("[Dry-run] Найдено устаревших заявок: {$count}. Никакие данные не изменены.");
            return 0;
        }

        if (!$this->confirm("Вы уверены, что хотите закрыть {$count} заявок?", false)) {
            $this->output->writeln('<info>Операция отменена пользователем.</info>');
            return 0;
        }

        $bookings = $query->get();
        $bar = $this->output->createProgressBar($count);
        $bar->start();

        foreach ($bookings as $booking) {
            DB::table('bookings')
                ->where('id', $booking->id)
                ->update(['status' => 'closed']);
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nУспешно закрыто заявок: {$count}.");

        $updatedBookings = DB::table('bookings')
            ->join('owners', 'bookings.user_id', '=', 'owners.user_id')
            ->select('owners.name as owner', 'bookings.status as status')
            ->get()
            ->map(fn($item) => [$item->owner, $item->status])
            ->toArray();

        $this->table(['Владелец', 'Статус'], $updatedBookings);

        return 0;
    }
}
