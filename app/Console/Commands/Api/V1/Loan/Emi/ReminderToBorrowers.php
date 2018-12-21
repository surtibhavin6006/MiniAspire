<?php

namespace App\Console\Commands\Api\V1\Loan\Emi;

use Illuminate\Console\Command;

class ReminderToBorrowers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emi:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send email reminder to all borrower of this month';

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
        //Todo : handle logic to get all clients from emi table with current month and year and ask them to pay emi due to 5 dec
        // send mail to all collectoins using notification
    }
}
