<?php


namespace App\Parser\Command;


use App\Metamodel\Services\GenerateHtmlService;
use App\Metamodel\Services\GenerateMetamodelService;
use App\Parser\Services\FileService;
use App\Transformation\Services\TransformMetamodelService;
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

    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * @var GenerateMetamodelService
     */
    protected $generateMetamodelService;

    /**
     * @var TransformMetamodelService
     */
    protected $transformMetamodelService;

    /**
     * @var GenerateHtmlService
     */
    protected $generateHtmlService;

    protected $time;

    /**
     * TransformationCommand constructor.
     * @param FileService $fileService
     * @param GenerateMetamodelService $generateMetamodelService
     */
    public function __construct(FileService $fileService, GenerateMetamodelService $generateMetamodelService, TransformMetamodelService $transformMetamodelService, GenerateHtmlService $generateHtmlService)
    {
        parent::__construct();
        $this->fileService = $fileService;
        $this->generateMetamodelService = $generateMetamodelService;
        $this->transformMetamodelService = $transformMetamodelService;
        $this->generateHtmlService = $generateHtmlService;
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

        $this->time = microtime(true);
        $output->writeln('> Read file');
        $fileContent = $this->fileService->readFile($inputFile);
        $this->printOutputProgress('Generate model', $output);
        $model = $this->generateMetamodelService->generate($fileContent);
        $this->printOutputProgress('Transform model', $output);
        $transformedModel = $this->transformMetamodelService->transform($model);
        $this->printOutputProgress('Generate HTML', $output);
        $html = $this->generateHtmlService->generate($transformedModel);
        $this->printOutputProgress('Save to file', $output);
        $this->fileService->writeToFile($html, $outputDirectory);

        $output->writeln([
            "\t".'time: '.round(microtime(true) - $this->time, 4).' seconds',
            '============',
            'Successful finish!',
            '',
        ]);
    }

    private function printOutputProgress($text, $output) {
        $output->writeln([
            "\t".'time: '.round(microtime(true) - $this->time, 4).' seconds',
            '> '.$text
        ]);
        $this->time = microtime(true);
    }
}