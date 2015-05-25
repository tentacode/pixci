<?php

namespace spec\Pixci\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Dumper;

class ConfigurationManagerSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, Dumper $yamlDumper)
    {
        $this->setFilesystem($filesystem);
        $this->setYamlDumper($yamlDumper);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Pixci\Configuration\ConfigurationManager');
    }

    function it_check_that_config_file_exists($filesystem)
    {
        $filesystem->exists($this->fakeConfigPath())->willReturn(true);

        $this->configFileExists()->shouldReturn(true);
    }

    function it_check_that_config_file_does_not_exists($filesystem)
    {
        $filesystem->exists($this->fakeConfigPath())->willReturn(false);

        $this->configFileExists()->shouldReturn(false);
    }

    function it_creates_a_config_file($filesystem, $yamlDumper)
    {   
        $yamlDumper->dump(Argument::withKey('pixci_directory'), 3)->willReturn('someyaml: blah');

        $filesystem->dumpFile($this->fakeConfigPath(), 'someyaml: blah')->shouldBeCalled();

        $this->createConfigFile();
    }

    protected function fakeConfigPath()
    {
        $scriptPath = realpath($_SERVER['SCRIPT_FILENAME']);
        $rootDirectory = str_replace($_SERVER['SCRIPT_FILENAME'], '', $scriptPath);
        $rootDirectory = rtrim($rootDirectory, '/');

        return sprintf('%s/pixci.yml', $rootDirectory);
    }
}
