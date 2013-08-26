<?php

/*
 * This file is part of the OODP package.
 *
 * (c) Jeff Anderson <jeffa@unlocalhost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

spl_autoload_register(function($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    foreach (array('src', 'tests') as $dirPrefix) {
        $file = __DIR__.'/../'.$dirPrefix.'/'.$path.'.php';
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
    }
});
