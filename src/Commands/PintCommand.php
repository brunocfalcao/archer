<?php

namespace Brunocfalcao\Archer\Commands;

use Illuminate\Console\Command;

class PintCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pint2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes the laravel/pint binary executable';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = str_replace(
            ['\\', '/'],
            DIRECTORY_SEPARATOR,
            base_path('vendor/bin/pint')
        );

        $this->shell($path);

        return 0;
    }
}
