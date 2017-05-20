<?php

namespace GitRate\Test\Application\Command;

use GitRate\Application\Command\GitLog;

class GitLogTest extends \PHPUnit_Framework_TestCase
{
    /** @test * */
    public function callAGitLogObtainAnArray()
    {
        $log = new GitLog();
        $this->assertTrue(is_array($log->execute()));
    }
}
