<?php

namespace GitRate\Application\Service;

use GitRate\Application\Exception\NotContainAValidAuthorFormat;
use GitRate\Domain\Author\Author;

class GitLogParser
{
    const ADDED = 'added';
    const DELETED = 'deleted';
    const FILE = 'file';

    /**
     * Check if line begins with a '>'
     *
     * @param string $aLine Line to parse
     * @return bool
     */
    public function isCommit($aLine): bool
    {
        $line = $this->clean($aLine);
        return (strpos($line, '>') === 0);
    }

    private function clean($rawLine): string
    {
        return trim($rawLine);
    }

    /**
     * Parse line of git output and commit author name and email
     * $line = name <name@email.com>
     * @param string $line Line to parse
     * @return Author
     */
    public function obtainAuthor($line): Author
    {
        preg_match('/^> (.*) <(.*)>$/', $line, $matches);
        if (!$this->containAnAuthor($matches)) {
            throw new NotContainAValidAuthorFormat("This line not contain an valid Author format: {$line}");
        }
        return new Author($matches[1], $matches[2]);
    }

    /**
     * @param $matches
     * @return bool
     */
    private function containAnAuthor($matches): bool
    {
        return count($matches) > 2;
    }

    /**
     * Parse line of git output and return number of added lines, number of deleted, and file name
     *
     * @param string $aLine Line to parse
     * @return array
     */
    public function obtainStats($aLine)
    {
        $line = $this->clean($aLine);
        // $line = "1337   43   some/file.ext"
        // $line = "-      -    some/file.bin"
        preg_match('/^([\-|\d]+)\s+([\-|\d]+)\s+(.*)$/', $line, $matches);
        return [
            self::ADDED => isset($matches[1]) ? intval($matches[1]) : 0,
            self::DELETED => isset($matches[2]) ? intval($matches[2]) : 0,
            self::FILE => isset($matches[3]) ? $matches[3] : null,
        ];
    }
}
