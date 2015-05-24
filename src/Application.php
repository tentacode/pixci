<?php

namespace Pixci;

use Silly\Application as SillyApplication;
use Symfony\Component\Console\Output\OutputInterface;

class Application extends SillyApplication
{
    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->addPixciCommands();
    }

    protected function addPixciCommands()
    {
        $this->command('greet [name] [--yell]', function ($name, $yell, OutputInterface $output) {
            if ($name) {
                $text = 'Hello, '.$name;
            } else {
                $text = 'Hello';
            }

            if ($yell) {
                $text = strtoupper($text);
            }

            $output->writeln($text);
        });
    }
}
