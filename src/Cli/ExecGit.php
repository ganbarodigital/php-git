<?php

/**
 * Copyright (c) 2015-present Ganbaro Digital Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Libraries
 * @package   Git/Cli
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-git
 */

namespace GanbaroDigital\Git\Cli;

use GanbaroDigital\EventStream\Streams\EventStream;
use GanbaroDigital\Git\Exceptions\E4xx_UnsupportedType;
use GanbaroDigital\Git\Repo\Requirements\RequireGitRepo;
use GanbaroDigital\ProcessRunner\ProcessRunners\PopenProcessRunner;
use GnabaroDigital\ProcessRunner\Values\ProcessResult;
use Traversable;

class ExecGit
{
    /**
     * run a git command inside a local Git repository
     *
     * @param  string $repoDir
     *         the location of the Git repo
     * @param  array|Traversable $command
     *         the command to run
     * @param  EventStream|null $eventStream
     *         the (optional) stream to send events to
     * @return ProcessResult
     *         the result of running the command
     */
    public function __invoke($repoDir, $command, EventStream $eventStream = null)
    {
        return self::run($repoDir, $command);
    }

    /**
     * run a git command inside a local Git repository
     *
     * @param  string $repoDir
     *         the location of the Git repo
     * @param  array|Traversable $command
     *         the command to run
     * @param  EventStream|null $eventStream
     *         the (optional) stream to send events to
     * @return ProcessResult
     *         the result of running the command
     */
    public static function run($repoDir, $command, EventStream $eventStream = null)
    {
        // defensive programming!
        RequireGitRepo::check($repoDir);

        // run the command
        return PopenProcessRunner::run($command, null, $repoDir, $eventStream);
    }
}