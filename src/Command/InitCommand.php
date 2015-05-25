<?php

namespace Pixci\Command;

use Pixci\Configuration\ConfigurationManager;

class InitCommand extends BaseCommand
{
    public function __construct(ConfigurationManager $configurationManager = null)
    {
        $this->configurationManager = $configurationManager ?: new ConfigurationManager();
    }

    public function action()
    {
        if ($this->configurationManager->configFileExists()) {
            $this->output->writeln('<comment>Pixci is already initialized, pixci.yml file exists.</comment>');

            return;
        }

        $this->configurationManager->createConfigFile();

        $this->output->writeln(
            '<info>Pixci configuration file "pixci.yml" has been created.</info>'
        );
    }
}
