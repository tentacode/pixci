<?php

namespace Pixci;

use Silly\Application as SillyApplication;
use Symfony\Component\Console\Output\OutputInterface;
use Pixci\Command;

class Application extends SillyApplication
{
    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->addPixciCommands();
    }

    protected function addPixciCommands()
    {
        $this->command('init', new Command\InitCommand());
    }
}
