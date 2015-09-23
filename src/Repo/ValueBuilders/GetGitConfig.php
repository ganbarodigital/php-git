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
 * @package   Git/Repo/ValueBuilders
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2015-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/php-git
 */

namespace GanbaroDigital\Git\Repo\ValueBuilders;

use GanbaroDigital\Git\Cli\ExecGit;
use GanbaroDigital\Git\Exceptions\E4xx_UnsupportedType;
use GanbaroDigital\Reflection\Requirements\RequireStringy;
use GanbaroDigital\TextTools\Editors\ReplaceMatchingRegex;
use GanbaroDigital\TextTools\Editors\TrimWhitespace;

class GetGitConfig
{
    public function __invoke($repoDir, $configName)
    {
        return self::from($repoDir, $configName);
    }

    public static function from($repoDir, $configName)
    {
        // defensive programming
        RequireStringy::check($configName, E4xx_UnsupportedType::class);

        // ask Git for the details
        $result = ExecGit::run($repoDir, ['git', 'config', $configName]);

        // tidy up the returned text
        $config = self::parseOutput($result->getOutput());

        // all done
        return $config;
    }

    private static function parseOutput($output)
    {
        // tidy up the returned text
        $config = explode(PHP_EOL, $output, -1);
        $config = TrimWhitespace::from($config);

        // all done
        return $config;
    }
}