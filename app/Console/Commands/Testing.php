<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command for run debuging';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
