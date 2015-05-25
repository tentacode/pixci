<?php

namespace Pixci\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

trait FilesystemTrait
{
    protected $filesystem;

    public function setFilesystem(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    protected function getFilesystem()
    {
        if (null === $this->filesystem) {
            $this->filesystem = new Filesystem();
        }

        return $this->filesystem;
    }

    protected function getRootDirectory()
    {
        $scriptPath = realpath($_SERVER['SCRIPT_FILENAME']);
        $rootDirectory = str_replace($_SERVER['SCRIPT_FILENAME'], '', $scriptPath);

        return rtrim($rootDirectory, '/');
    }
}