<?php


namespace App\Parser\Command;


use App\Metamodel\Services\GenerateMetamodelService;
use App\Parser\Services\FileService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TransformationCommand extends Command
{
    const OPTION_INPUT_FILE = 'input-file';
    const OPTION_OUTPUT_DIRECTORY = 'output-directory';
    protected static $defaultName = 'transformation:run';
    protected $fileService;
    protected $generateMetamodelService;

    /**
     * TransformationCommand constructor.
     * @param FileService $fileService
     * @param GenerateMetamodelService $generateMetamodelService
     */
    public function __construct(FileService $fileService, GenerateMetamodelService $generateMetamodelService)
    {
        parent::__construct();
        $this->fileService = $fileService;
        $this->generateMetamodelService = $generateMetamodelService;
    }


    protected function configure()
    {
        $this
            ->addOption(
                self::OPTION_INPUT_FILE,
                'i',
                InputOption::VALUE_REQUIRED,
                'Input file'
            )
            ->addOption(
                self::OPTION_OUTPUT_DIRECTORY,
                'o',
                InputOption::VALUE_REQUIRED,
                'Output directory'
            )
            ->setDescription('Transform your AngularJs to Angular.')
            ->setHelp('This command allows you to transformate AngularJS to Angular');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Transformation start',
            '============',
            '',
        ]);

        $inputFile = $input->getOption(self::OPTION_INPUT_FILE);
        $outputDirectory = $input->getOption(self::OPTION_OUTPUT_DIRECTORY);

        if (trim($inputFile) == '') {
            throw new InvalidOptionException('No input file option');
        }

        if (trim($outputDirectory) == '') {
            throw new InvalidOptionException('No output directory option');
        }

        $output->writeln('Input file: ' . $inputFile);
        $output->writeln('Output directory: ' . $outputDirectory);

        $fileContent = $this->fileService->readFile($inputFile);
        $model = $this->generateMetamodelService->generate($fileContent);

        dump($model);

        $output->writeln([
            '============',
            'Successful finish!',
            '',
        ]);
    }
}