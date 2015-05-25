<?php

namespace spec\Pixci\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pixci\Configuration\ConfigurationManager;

class InitCommandSpec extends ObjectBehavior
{
    function let(InputInterface $input, OutputInterface $output, ConfigurationManager $configurationManager)
    {
        $this->beConstructedWith($configurationManager);
        $this->setInput($input);
        $this->setOutput($output);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Pixci\Command\InitCommand');
        $this->shouldHaveType('Pixci\Command\BaseCommand');
    }

    function it_does_not_create_config_file_if_it_exists($configurationManager, $input, $output)
    {
        $configurationManager->configFileExists()->willReturn(true);
        $configurationManager->createConfigFile()->shouldNotBeCalled();
        $output
            ->writeln('<comment>Pixci is already initialized, pixci.yml file exists.</comment>')
            ->shouldBeCalled()
        ;

        $this->action();
    }

    function it_creates_config_file_if_it_does_not_exists($configurationManager, $input, $output)
    {
        $configurationManager->configFileExists()->willReturn(false);
        $configurationManager->createConfigFile()->shouldBeCalled();
        $output
            ->writeln('<info>Pixci configuration file "pixci.yml" has been created.</info>')
            ->shouldBeCalled()
        ;

        $this->action();
    }
}
