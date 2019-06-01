<?php


namespace App\FileManager\Service;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\NoFileException;

class FileManager
{
    protected $filesystem;

    /**
     * FileService constructor.
     */
    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }


    public function readFile($fileName)
    {
        if (!$this->filesystem->exists($fileName)) {
            throw new NoFileException();
        }

        return file_get_contents($fileName);
    }

    public function writeToFile(string $html, $outputDirectory, $inputFile)
    {
        $this->filesystem->mkdir($outputDirectory);
        $this->filesystem->dumpFile($outputDirectory.'/'.basename($inputFile), $html);
    }
}