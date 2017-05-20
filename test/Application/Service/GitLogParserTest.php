<?php

namespace GitRate\Test\Application\Service;

use GitRate\Application\Service\GitLogParser;
use GitRate\Domain\Author\Author;

class GitLogParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var  GitLogParser */
    private $parser;

    /** @test * */
    public function a_line_is_commit_if_start_with_bigger_than_symbol()
    {
        $result = $this->parser->isCommit('  not > a Commit  ');
        $this->assertFalse($result);

        $result = $this->parser->isCommit('> is a Commit  ');
        $this->assertTrue($result);
    }

    /** @test
     * @expectedException \GitRate\Application\Exception\NotContainAValidAuthorFormat
     */
    public function given_a_line_with_author_obtain_an_author()
    {
        $result = $this->parser->obtainAuthor("> Jesús LC <hola@jesuslc.com>\n");
        $this->assertInstanceOf(Author::class, $result);
        $this->assertEquals('Jesús LC', $result->name());
        $this->assertEquals('hola@jesuslc.com', $result->email());

        $invalidLine = " Jesús LC <hola@jesuslc.com>\n";
        $this->parser->obtainAuthor($invalidLine);
    }

    /** @test */
    public function given_a_line_with_file_obtain_stats()
    {
        $result = $this->parser->obtainStats("26	5	src/Application/Service/GitLogService.php\n");
        $this->assertArrayHasKey(GitLogParser::ADDED, $result);
        $this->assertEquals(26, $result[GitLogParser::ADDED]);
        $this->assertArrayHasKey(GitLogParser::DELETED, $result);
        $this->assertEquals(5, $result[GitLogParser::DELETED]);
        $this->assertArrayHasKey(GitLogParser::FILE, $result);
        $this->assertEquals('src/Application/Service/GitLogService.php',
            $result[GitLogParser::FILE]);
    }

    protected function setUp()
    {
        $this->parser = new GitLogParser();
    }
}
