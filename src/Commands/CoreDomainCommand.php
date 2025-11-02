<?php

namespace IncadevUns\CoreDomain\Commands;

use Illuminate\Console\Command;

class CoreDomainCommand extends Command
{
    public $signature = 'core-domain';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
