<?php

namespace GitRate\Infrastructure\Ui\Console;

use GitRate\Application\Command\GitLog;
use GitRate\Application\Service\GitLogParser;
use GitRate\Application\Service\ScoreService;
use GitRate\Domain\Author\Author;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitScoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('git-score')
            ->setDescription('List of contributors of a git repo order by contributions')
            ->setHelp('This command allows you to show a list of contributors');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $authors = (new ScoreService(new GitLog(),
            new GitLogParser()))->execute();

        $table = new Table($output);
        $table->setHeaders([
            'name',
            'email',
            'commits',
            'delta',
            '(+)',
            '(-)',
            'files',
        ]);
        /** @var Author $author */
        foreach ($authors->getAll() as $author) {
            $table->addRow([
                $author->name(),
                $author->email(),
                $author->commits(),
                $author->delta(),
                $author->added(),
                $author->deleted(),
                $author->numFiles()
            ]);
        }
        $table->render();
    }
}
