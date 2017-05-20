<?php

namespace GitRate\Domain\Author;

class Author
{
    /** @var  string */
    private $name;
    /** @var  string */
    private $email;
    /** @var  int */
    private $commits;
    /** @var  int */
    private $added;
    /** @var  int */
    private $deleted;
    /** @var  int */
    private $numFiles;
    /** @var  array */
    private $files;

    /**
     * Author constructor.
     * @param string $name
     * @param string $email
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
        $this->commits = 0;
        $this->added = 0;
        $this->deleted = 0;
        $this->numFiles = 0;
        $this->files = [];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function commits(): int
    {
        return $this->commits;
    }

    public function delta(): int
    {
        return $this->added - $this->deleted;
    }

    public function added(): int
    {
        return $this->added;
    }

    public function deleted(): int
    {
        return $this->deleted;
    }

    public function addCommit()
    {
        $this->commits++;
    }

    public function addAdded($adAdded)
    {
        $this->added += intval($adAdded);
    }

    public function addDeleted($aDeleted)
    {
        $this->deleted += intval($aDeleted);
    }

    public function addFiles($files)
    {
        if (!in_array($files, $this->files)) {
            $this->files[] = $files;
        }
        $this->numFiles = count($this->files);
    }

    public function files(): array
    {
        return $this->files;
    }

    public function numFiles(): int
    {
        return $this->numFiles;
    }
}
