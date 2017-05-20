<?php

namespace GitRate\Test\Application\Service;

use GitRate\Application\Service\GitLogParser;
use GitRate\Application\Service\ScoreService;
use GitRate\Domain\Author\Author;
use GitRate\Domain\Dictionary\Dictionary;
use GitRate\Test\Application\Service\fake\FakeGitLog;

class ScoreServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var ScoreService */
    private $service;
    /** @var  FakeGitLog */
    private $fakeLog;

    /** @test */
    public function if_no_commits_then_zero_result()
    {
        $this->fakeLog->setNumberOfAuthorWithCommits(0);
        $score = $this->service->execute();
        $this->assertInstanceOf(Dictionary::class, $score);
        $this->assertCount(0, $score->getAll());
    }

    /** @test */
    public function if_there_are_an_author_then_a_result()
    {
        $this->fakeLog->setNumberOfAuthorWithCommits(1);
        $score = $this->service->execute();
        $this->assertInstanceOf(Dictionary::class, $score);
        $dictionary = $score->getAll();
        $this->assertCount(1, $dictionary);
        /** @var Author $firstElement */
        $firstElement = array_pop($dictionary);
        $this->assertInstanceOf(Author::class, $firstElement);
        $this->assertEquals(2, $firstElement->commits());
        $this->assertEquals(-79, $firstElement->delta());
        $this->assertEquals(296, $firstElement->added());
        $this->assertEquals(375, $firstElement->deleted());
        $this->assertEquals(7, $firstElement->numFiles());
        $this->assertCount(7, $firstElement->files());
    }

    /** @test */
    public function if_there_are_two_authors_then_two_result()
    {
        $this->fakeLog->setNumberOfAuthorWithCommits(2);
        $score = $this->service->execute();
        $this->assertInstanceOf(Dictionary::class, $score);
        $dictionary = $score->getAll();
        $this->assertCount(2, $dictionary);
        $firstElement = array_pop($dictionary);
        $this->assertInstanceOf(Author::class, $firstElement);
    }

    /** @test */
    public function if_there_are_various_authors_then_various_result()
    {
        $this->fakeLog->setNumberOfAuthorWithCommits(3);
        $score = $this->service->execute();
        $this->assertInstanceOf(Dictionary::class, $score);
        $dictionary = $score->getAll();
        $this->assertCount(3, $dictionary);
        $firstElement = array_pop($dictionary);
        $this->assertInstanceOf(Author::class, $firstElement);
    }

    protected function setUp()
    {
        $this->fakeLog = new FakeGitLog();
        $this->service = new ScoreService($this->fakeLog, new GitLogParser());
    }
}
