<?php

namespace App\Console\Commands\Api\V1\User;

use App\Repository\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UserVerifyById extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:verify {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will verify user';

    protected $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * @throws \App\Exceptions\GeneralException
     */
    public function handle()
    {
        $userId = $this->argument('user_id');

        $attributes = array(
            'email_verified_at' => Carbon::now()
        );

        $this->user->update($userId, $attributes);

        $this->info('Done. ' . PHP_EOL);

    }
}
