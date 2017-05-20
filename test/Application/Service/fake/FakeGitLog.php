<?php

namespace GitRate\Test\Application\Service\fake;

use GitRate\Application\Command\GitLog;

class FakeGitLog extends GitLog
{
    private $numberOfAuthorWithCommits = 0;

    /**
     * @param mixed $numberOfAuthorWithCommits
     */
    public function setNumberOfAuthorWithCommits($numberOfAuthorWithCommits)
    {
        $this->numberOfAuthorWithCommits = $numberOfAuthorWithCommits;
    }


    public function execute(): array
    {
        return $this->fakeGitLogOutput();
    }

    private function fakeGitLogOutput()
    {
        $result = [];
        switch ($this->numberOfAuthorWithCommits) {
            case 0:
                $result = [];
                break;
            case 1:
                $result = [
                    "> Jesús LC <hola@jesuslc.com>\n",
                    "1\t1\tsrc/Score.php\n",
                    "4\t5\ttest/ScoreServiceTest.php\n",
                    "13\t0\ttest/ScoreWrapper.php\n",
                    "\n",
                    "> Jesús LC <hola@jesuslc.com>\n",
                    "6\t1\tcomposer.json\n",
                    "133\t269\tcomposer.lock\n",
                    "27\t0\tphpunit.xml\n",
                    "98\t99\tsrc/Score.php\n",
                    "14\t0\ttest/ScoreServiceTest.php\n",
                    "\n",
                    false
                ];
                break;
            case 2:
                $result = [
                    "> Jesús LC <hola@jesuslc.com>\n",
                    "1\t1\tsrc/Score.php\n",
                    "4\t5\ttest/ScoreServiceTest.php\n",
                    "13\t0\ttest/ScoreWrapper.php\n",
                    "\n",
                    "> Manuel <manuel@gmail.com>\n",
                    "6\t1\tcomposer.json\n",
                    "133\t269\tcomposer.lock\n",
                    "27\t0\tphpunit.xml\n",
                    "98\t99\tsrc/Score.php\n",
                    "14\t0\ttest/ScoreServiceTest.php\n",
                    "\n",
                    "> Manuel <manuel@gmail.com>\n",
                    "6\t1\tcomposer.json\n",
                    "133\t269\tcomposer.lock\n",
                    "27\t0\tphpunit.xml\n",
                    "98\t99\tsrc/Score.php\n",
                    "14\t0\ttest/ScoreServiceTest.php\n",
                    "\n",
                    "> Manuel <manuel@gmail.com>\n",
                    "6\t1\tcomposer.json\n",
                    "133\t269\tcomposer.lock\n",
                    "27\t0\tphpunit.xml\n",
                    "98\t99\tsrc/Score.php\n",
                    "14\t0\ttest/ScoreServiceTest.php\n",
                    "\n",
                    "> Manuel <manuel@gmail.com>\n",
                    "6\t1\tcomposer.json\n",
                    "133\t269\tcomposer.lock\n",
                    "27\t0\tphpunit.xml\n",
                    "98\t99\tsrc/Score.php\n",
                    "14\t0\ttest/ScoreServiceTest.php\n",
                    "\n",
                    false
                ];
                break;
            case 3:
                $result = [
                    "> Jesús LC <hola@jesuslc.com>\n",
                    "1\t1\tsrc/Score.php\n",
                    "\n",
                    "> Jesús LC <hola@jesuslc.com>\n",
                    "1\t1\tsrc/Score.php\n",
                    "\n",
                    "> Manuel <manuel@gmail.com>\n",
                    "6\t1\tcomposer.json\n",
                    "98\t99\tsrc/Score.php\n",
                    "14\t0\ttest/ScoreServiceTest.php\n",
                    "\n",
                    "> Daniel <daniel@gmail.com>\n",
                    "98\t99\tsrc/Score.php\n",
                    "14\t0\ttest/ScoreServiceTest.php\n",
                    "\n",
                    false
                ];
                break;
        }
        return $result;
    }
}
