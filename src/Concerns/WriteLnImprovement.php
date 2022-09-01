<?php

namespace Brunocfalcao\Archer\Concerns;

trait WriteLnImprovement
{
    protected function paragraph($text, $startlf = false, $endlf = true)
    {
        if ($startlf) {
            $this->info('');
        }

        $this->info($text);

        if ($endlf) {
            $this->info('');
        }
    }
}
