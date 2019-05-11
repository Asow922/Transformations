<?php


namespace App\Parser\Services;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\NoFileException;

class FileService
{
    protected $filesystem;

    /**
     * FileService constructor.
     */
    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }


    public function readFile($fileName) {
        if (!$this->filesystem->exists($fileName)) {
            throw new NoFileException();
        }

        return file_get_contents($fileName);
    }
}