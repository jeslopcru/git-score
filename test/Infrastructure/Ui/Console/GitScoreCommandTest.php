<?php

namespace GitRate\Test\Infrastructure\Ui\Console;

use GitRate\Infrastructure\Ui\Console\GitScoreCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GitScoreCommandTest extends \PHPUnit_Framework_TestCase
{

    /** @test * */
    public function output_console()
    {
        $application = new Application();
        $application->add(new GitScoreCommand());

        $command = $application->find('git-score');

        $tester = new CommandTester($command);
        $tester->execute(['command' => $command->getName()]);

        $this->assertContains(
            "| name      | email               | commits | delta | (+)  | (-) | files |",
            $tester->getDisplay());
    }
}
