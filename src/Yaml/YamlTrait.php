<?php

namespace Pixci\Yaml;

use Symfony\Component\Yaml\Dumper;

trait YamlTrait
{
    protected $yamlDumper;

    public function setYamlDumper(Dumper $yamlDumper)
    {
        $this->yamlDumper = $yamlDumper;
    }

    protected function getYamlDumper()
    {
        if (null === $this->yamlDumper) {
            $this->yamlDumper = new Dumper();
        }

        return $this->yamlDumper;
    }
}