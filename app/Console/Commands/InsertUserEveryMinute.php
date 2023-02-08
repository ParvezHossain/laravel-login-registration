<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertUserEveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:InsertUser';

    /**
     * The console command description.
     *
     * @var string
     */
    // return [
    //     'title' => fake()->sentence(),
    //     'source' => fake()->city(),
    //     'destination' => fake()->city(),    
    // ];
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        DB::table('flights')->insert([
            'title' => fake()->sentence(),
            'source' => fake()->city(),
            'destination' => fake()->city(),
        ]);
    }
}
