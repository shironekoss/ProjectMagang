<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncDatabase:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncing Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $response = Http::get('http://localhost:8000/api/getdataspk');
            Log::info($response);
            $response2 = Http::get('http://localhost:8000/api/getdatakit');
            Log::info($response2);
            Log::info("Cron is Working fine");
            // Log::info($response);
            // Log::info("Cron is Working fine");
            // Log::info($response2);
        } catch (\Throwable $th) {
            Log::info("Cron is not working");
        }

    }
}
