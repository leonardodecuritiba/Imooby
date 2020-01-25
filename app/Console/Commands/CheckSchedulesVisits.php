<?php

namespace App\Console\Commands;

use App\Models\Visit;
use Illuminate\Console\Command;

class CheckSchedulesVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:check_visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check an update scheduled visits';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach(Visit::all() as $visit) {
            $visit->checkStatus();
        }
    }
}
