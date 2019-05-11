<?php

namespace App\Tests\Parser\Command;

use App\Parser\Command\TransformationCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Tester\CommandTester;

class TransformationCommandTest extends KernelTestCase
{
    public function testNoOutputOptionExecute()
    {
        $this->expectException(InvalidOptionException::class);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find(TransformationCommand::getDefaultName());
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            '-i' => 'input',
        ]);
    }

    public function testNoInputOptionExecute()
    {
        $this->expectException(InvalidOptionException::class);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find(TransformationCommand::getDefaultName());
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            '-o' => 'output',
        ]);

    }
}
