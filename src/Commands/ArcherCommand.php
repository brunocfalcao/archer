<?php

namespace Brunocfalcao\Archer\Commands;

use Illuminate\Console\Command;

class ArcherCommand extends Command
{
    public $signature = 'archer';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
