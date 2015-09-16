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
 * @package   GitRepo/Requirements
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-git-repo
 */

namespace GanbaroDigital\GitRepo\Requirements;

use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass GanbaroDigital\GitRepo\Requirements\RequireGitRepo
 */
class RequireGitRepoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @coversNothing
     */
    public function testCanInstantiate()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        $obj = new RequireGitRepo;

        // ----------------------------------------------------------------
        // test the results

        $this->assertTrue($obj instanceof RequireGitRepo);
    }

    /**
     * @covers ::__invoke
     */
    public function testCanUseAsObject()
    {
        // ----------------------------------------------------------------
        // setup your test

        $obj = new RequireGitRepo;
        $repoDir = realpath(__DIR__ . '/../..');

        // ----------------------------------------------------------------
        // perform the change

        $obj($repoDir);

        // ----------------------------------------------------------------
        // test the results
        //
        // if we get here without an exception, the test has passed
    }

    /**
     * @covers ::check
     */
    public function testCanCallStatically()
    {
        // ----------------------------------------------------------------
        // setup your test

        // ----------------------------------------------------------------
        // perform the change

        RequireGitRepo::check(realpath(__DIR__ . '/../..'));

        // ----------------------------------------------------------------
        // test the results
        //
        // if we get here without an exception, the test has passed
    }

    /**
     * @covers ::check
     * @expectedException GanbaroDigital\GitRepo\Exceptions\E4xx_NotGitRepo
     */
    public function testThrowsExceptionWhenGivenAFolderOutsideGitRepo()
    {
        // ----------------------------------------------------------------
        // setup your test
        //
        // we need a system folder, because it's certain to be a non-git
        // repo
        if (is_dir("/usr")) {
            $repoDir = "/usr";
        }
        else if (is_dir("c:\\")) {
            $repoDir = "c:\\";
        }

        // ----------------------------------------------------------------
        // perform the change

        RequireGitRepo::check($repoDir);
    }
}