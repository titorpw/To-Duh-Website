<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates event status to completed if event_date has passed.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mencari event yang sudah lewat batas waktu...');

        $events = Event::where('event_date', '<', Carbon::now())
            ->where('is_completed', false)
            ->get();

        if ($events->isEmpty()) {
            $this->info('Tidak ada event yang perlu diperbarui.');
            return Command::SUCCESS;
        }

        $count = 0;
        foreach ($events as $event) {
            $event->is_completed = true;
            $event->save();
            $count++;
        }

        $this->info($count . ' event berhasil diperbarui menjadi completed.');

        return Command::SUCCESS;
    }
}
