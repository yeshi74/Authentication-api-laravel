<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\LibForms;
class Q4eAutoClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'q4e:autoclose';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Q4E Autoclose Forms';

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
        LibForms::autoClose();
    }
}
