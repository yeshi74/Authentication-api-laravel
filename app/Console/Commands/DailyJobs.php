<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\LibAPI;
class DailyJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Jobs';

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
        //
        //LibAPI::updateLocations();
        LibApi::test();
    }
}
