<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\LibForms;
use App\Helpers\LibAssignments;
class Q4eAssignments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'q4e:assignments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Q4E Assignments';

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
        LibAssignments::outcomeAssignments();
        LibAssignments::generateAssignments();
        LibAssignments::checkListAssignments();
    }
}
