<?php

namespace Brunocfalcao\Archer\Commands;

use Illuminate\Console\Command;

class ImportCsvCommand extends Command
{
    protected $signature = 'archer:import-csv name?';

    protected $description = "Imports a CSV file into a database table, or all csv files located in base_path('resources/csvs')";

    public function handle()
    {
        $this->info('
    // | |
   //__| |     __      ___     / __      ___      __
  / ___  |   //  ) ) //   ) ) //   ) ) //___) ) //  ) )
 //    | |  //      //       //   / / //       //
//     | | //      ((____   //   / / ((____   //        ');

        // Assess what file(s) should we work on.
        $files = glob(resource_path('csvs/'.
                        $this->argument('name') ?
                            $this->argument('name').'.csv' :
                            '*'));

        return self::SUCCESS;
    }
}
