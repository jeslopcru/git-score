<?php

namespace GitRate\Domain\Dictionary;

use GitRate\Domain\Author\Author;

class Dictionary
{
    private $dictionary = [];

    public function getAll()
    {
        return $this->dictionary;
    }

    public function add(Author $anAuthor): Author
    {
        $theAuthor = $this->get($anAuthor->email());;
        if (empty($theAuthor)) {
            $this->set($anAuthor->email(), $anAuthor);
            $theAuthor = $anAuthor;
        }
        return $theAuthor;
    }

    public function get($key)
    {
        $result = null;
        if (array_key_exists($key, $this->dictionary)) {
            $result = $this->dictionary[$key];
        }
        return $result;
    }

    public function set($key, $value)
    {
        $this->dictionary[$key] = $value;
    }
}
