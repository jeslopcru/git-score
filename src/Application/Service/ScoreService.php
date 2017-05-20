<?php

namespace GitRate\Application\Service;

use GitRate\Application\Command\GitLog;
use GitRate\Domain\Dictionary\Dictionary;

class ScoreService
{
    /** @var  GitLog */
    private $log;
    /** @var GitLogParser */
    private $parser;

    public function __construct(GitLog $log, GitLogParser $parser)
    {
        $this->log = $log;
        $this->parser = $parser;
    }

    public function execute()
    {
        $authorList = new Dictionary();

        $log = $this->log->execute();

        foreach ($log as $line) {
            if ($this->parser->isCommit($line)) {
                $anAuthor = $authorList->add($this->parser->obtainAuthor($line));
                $anAuthor->addCommit();
                $authorList->set($anAuthor->email(), $anAuthor);
            }

            $stats = $this->parser->obtainStats($line);
            $anAuthor->addAdded($stats[GitLogParser::ADDED]);
            $anAuthor->addDeleted($stats[GitLogParser::DELETED]);
            $anAuthor->addFiles($stats[GitLogParser::FILE]);
            $authorList->set($anAuthor->email(), $anAuthor);
        }

        return $authorList;
    }
}
