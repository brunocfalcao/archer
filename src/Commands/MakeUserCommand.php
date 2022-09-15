<?php

namespace Brunocfalcao\Archer\Commands;

use Brunocfalcao\Archer\Concerns\CanValidateArguments;
use Illuminate\Console\Command;

class MakeUserCommand extends Command
{
    use CanValidateArguments;

    protected $signature = 'make:user';

    protected $description = 'Creates a new user, populates name, email and password';

    public function handle()
    {
        $this->info('
    // | |
   //__| |     __      ___     / __      ___      __
  / ___  |   //  ) ) //   ) ) //   ) ) //___) ) //  ) )
 //    | |  //      //       //   / / //       //
//     | | //      ((____   //   / / ((____   //        ');

        $name = $this->askWithRules('Name', ['required']);
        $email = $this->askWithRules('Email', ['required', 'email', 'unique:users,email']);
        $password = $this->askWithRules('Password', ['required', 'min:4']);

        $user = new (config('archer.user'))();

        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);

        $user->save();

        $this->info("User {$name} was made");

        return 0;
    }
}
