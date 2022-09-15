<?php

namespace Brunocfalcao\Archer\Commands;

use Brunocfalcao\Archer\Concerns\WriteLnImprovement;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    use WriteLnImprovement;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archer:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs archer utilities and helpers';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('
    // | |
   //__| |     __      ___     / __      ___      __
  / ___  |   //  ) ) //   ) ) //   ) ) //___) ) //  ) )
 //    | |  //      //       //   / / //       //
//     | | //      ((____   //   / / ((____   //        ');

        $this->publishCsFixer();
        $this->publishArcherResources();

        return 0;
    }

    protected function publishArcherResources()
    {
        $this->paragraph('=> Publishing archer resources ...', true);
        $this->call('vendor:publish', [
            '--provider' => "Brunocfalcao\Archer\ArcherServiceProvider",
            '--force' => true,
        ]);
    }

    protected function publishCsFixer()
    {
        $this->paragraph('=> Publishing laravel-code-style php-cs-fixer.dist.php ...', true);
        if (file_exists(base_path('.php-cs-fixer.dist.php'))) {
            $this->paragraph('.php-cs-fixer.dist.php already exists. Skipping ...');
        } else {
            $this->paragraph('!! Publishing .php-cs-fixer.dist.php ...');
            $this->call('vendor:publish', [
                '--provider' => "Jubeki\LaravelCodeStyle\ServiceProvider",
                '--force' => true,
            ]);
        }

        $data = json_decode(file_get_contents(base_path('composer.json')), true);

        if (! array_key_exists('check-style', $data['scripts']) ||
            ! array_key_exists('fix-style', $data['scripts'])) {
            $this->paragraph('=> Changing composer.json to include "composer fix-style" and "composer check-style" commands ...');

            if (! array_key_exists('check-style', $data['scripts'])) {
                $this->paragraph('!! Adding check-style key ...');
                $data['scripts']['check-style'] = 'php-cs-fixer fix --dry-run --diff';
            }

            if (! array_key_exists('fix-style', $data['scripts'])) {
                $this->paragraph('!! Adding fix-style key ...');
                $data['scripts']['fix-style'] = 'php-cs-fixer fix';
            }

            file_put_contents(
                base_path('composer.json'),
                json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            );

            $this->paragraph('!! Reloading composer ...');
            $this->shell('composer dumpautoload');
        }
    }
}
