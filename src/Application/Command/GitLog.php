<?php

namespace GitRate\Application\Command;

class GitLog
{
    /**
     *  const The git command which output we'll parse
     *
     * This will output something like:
     *
     *   > ozh <ozh@ozh.org>
     *   625     1747    includes/geo/geoip.inc
     *
     *   > Joe <em@i.l>
     *   2       0       .travis.yml
     *
     *   > ozh <ozh@ozh.org>
     *   22      0       CHANGELOG.md
     *   4       0       js/jquery-2.2.4.min.js
     *
     */
    const GIT_LOG_COMMAND = 'git log --use-mailmap --numstat --pretty=format:"> %aN <%aE>" --no-merges';

    /**
     * Exec git command and collect its output
     */
    public function execute(): array
    {
        $log = [];
        $handle = popen(self::GIT_LOG_COMMAND, 'r');
        while (!feof($handle)) {
            $log[] = fgets($handle, 4096);
        }
        pclose($handle);

        return $log;
    }
}
