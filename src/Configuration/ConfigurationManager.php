<?php

namespace Pixci\Configuration;

use Pixci\Filesystem\FilesystemTrait;
use Pixci\Yaml\YamlTrait;

class ConfigurationManager
{
    use FilesystemTrait, YamlTrait;

    const YAML_INLINE_LEVEL = 3;

    public function createConfigFile()
    {
        $yaml = $this->getYamlDumper()->dump($this->getDefaultConfiguration(), self::YAML_INLINE_LEVEL);
        $this->getFileSystem()->dumpFile($this->getConfigPath(), $yaml);
    }

    public function getDefaultConfiguration()
    {
        return [
            'pixci_directory' => 'pixci',
            'base_url' => 'http://localhost',
            'contexts' => [
                'default' => ['viewport' => [1080, 768]]
            ],
            'pages' => [
                'landing' => [
                    'contexts' => ['default'],
                    'url' => '/'
                ]
            ]
        ];
    }

    public function configFileExists()
    {
        return $this->getFileSystem()->exists($this->getConfigPath());
    }

    public function getConfigPath()
    {
        return sprintf('%s/pixci.yml', $this->getRootDirectory());
    }
}
