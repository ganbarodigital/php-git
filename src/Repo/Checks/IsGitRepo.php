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
 * @package   Git/Repo/Checks
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-git
 */

namespace GanbaroDigital\Git\Repo\Checks;

use GanbaroDigital\Filesystem\Checks\IsFolder;

/**
 * check that we're looking at a real Git repo
 *
 * This check has to be as strict as possible, and still be as fast as
 * possible. This prevents us running the `git` command itself as part of
 * our checks, as fork()-exec() is just too slow - especially if we're
 * being called hundreds of times during the execution of a process!
 */
class IsGitRepo
{
    /**
     * are we looking at a valid Git repo?
     *
     * @param  string $repoDir
     *         path to the git repo to examine
     * @return boolean
     *         TRUE if we are
     *         FALSE otherwise
     */
    public function __invoke($repoDir)
    {
        return self::check($repoDir);
    }

    /**
     * are we looking at a valid Git repo?
     *
     * @param  string $repoDir
     *         path to the git repo to examine
     * @return boolean
     *         TRUE if we are
     *         FALSE otherwise
     */
    public static function check($repoDir)
    {
        // we're going to check for the existence of all of these folders
        $foldersToCheck = [
            $repoDir,
            $repoDir . '/.git/refs/heads'
        ];
        foreach ($foldersToCheck as $folderToCheck) {
            if (!IsFolder::check($folderToCheck)) {
                return false;
            }
        }

        // if we get here, we've run out of ideas
        return true;
    }
}