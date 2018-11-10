<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial the database';

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
        $mode = $this->choice('Do you want to create a user or bind a user?', ['Create', 'Bind'], 0);

        if ($mode === 'Create') {
            $mobile = $this->ask('Please enter your mobile.');
            $password = $this->secret('Please enter a password.');

            $userId = DB::table('users')->insertGetId([
                'mobile' => $mobile,
                'password' => bcrypt($password),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->info("User [mobile:$mobile] created successfully.");
        } else {
            $userId = $this->ask('Please enter user id.');
        }

    }
}
