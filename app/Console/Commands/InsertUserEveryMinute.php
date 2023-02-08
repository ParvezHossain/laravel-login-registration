<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
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
    public function handle(Faker $faker)
    {
        // return Command::SUCCESS;
        DB::table('users')->insert([
            'name' => $faker->name,
            'username' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt("123456789"),
            'created_at' => date("Y-m-d h:i:s"),
        ]);
    }
}
