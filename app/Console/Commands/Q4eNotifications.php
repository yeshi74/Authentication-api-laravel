<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\LibNotifications;
class Q4eNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'q4e:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Q4E Notifications';

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
        LibNotifications::generateNotification();
    }
}
