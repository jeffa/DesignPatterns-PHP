# You can set these variables from the command line.
AUTHOR        = Author
PROJECT       = Project
BUILDFILE     = project.phar
SRCDIR        = src
TESTDIR       = tests
PHPUNITCONFIG = phpunit.xml.dist
BOOTSTRAP     = bootstrap.php
PHARBUILD     = $(shell which phar-build)

define phpunitxml
<?xml version="1.0" encoding="UTF-8"?>

<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         colors="true"
         convertErrorsToExceptions="true"
         convertNoticesToExceptions="true"
         convertWarningsToExceptions="true"
         processIsolation="false"
         stopOnFailure="false"
         syntaxCheck="false"
         bootstrap="$(TESTDIR)/$(BOOTSTRAP)"
>
    <testsuites>
        <testsuite name="All">
            <directory suffix="Test.php">./$(TESTDIR)/$(PROJECT)/</directory>
        </testsuite>
    </testsuites>

    <filter>
        <whitelist>
            <directory>./$(SRCDIR)/$(PROJECT)/</directory>
        </whitelist>
    </filter>
</phpunit>
endef

define bootstrap
<?php

/*
 * This file is part of the $(PROJECT) package.
 *
 * (c) $(AUTHOR)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

spl_autoload_register(function($$class)
{
    $$path = str_replace('\\\\', DIRECTORY_SEPARATOR, $$class);
    foreach (array('$(SRCDIR)', '$(TESTDIR)') as $$dirPrefix) {
        $$file = __DIR__.'/../'.$$dirPrefix.'/'.$$path.'.php';
        if (file_exists($$file)) {
            require_once $$file;
            return true;
        }
    }
});
endef

define stub
<?php
Phar::mapPhar();

$basePath = 'phar://' . __FILE__ . '/';

spl_autoload_register(function($$class) use ($$basePath)
{
    if (0 !== strpos($$class, "$(PROJECT)\\")) {
        return false;
    }
    $$path = str_replace('\\', DIRECTORY_SEPARATOR, substr($$class, 8));
    $$file = $$basePath.$$path.'.php';
    if (file_exists($$file)) {
        require_once $$file;
        return true;
    }
});

__HALT_COMPILER();
endef

define license
Copyright (c) $(shell date +%Y) $(AUTHOR)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
endef

export phpunitxml bootstrap stub license

help:
	@echo ""
	@echo "Please use \`make <target>' where <target> is one of"
	@echo ""
	@echo "  init    generate barebones PHP project."
	@echo ""
	@echo "          Will set up src/ and tests/ directories, add"
	@echo "          phpunit.xml.dist and tests/bootstrap.php and LICENSE"
	@echo ""
	@echo "          requires:"
	@echo "            PROJECT=Project"
	@echo "            AUTHOR=Author"
	@echo ""
	@echo "  destroy remove generated PHP project completely."
	@echo ""
	@echo "          Will remove up src/, tests/ directories, "
	@echo "          phpunit.xml.dist and LICENSE"
	@echo ""
	@echo "  build   generate a phar file for the current project with autoloading."
	@echo ""
	@echo ""

init:
	mkdir -p $(SRCDIR)/$(PROJECT)
	mkdir -p $(TESTDIR)/$(PROJECT)
	echo "$$phpunitxml" >> $(PHPUNITCONFIG)
	echo "$$bootstrap" >> $(TESTDIR)/$(BOOTSTRAP)
	echo "$$license" >> LICENSE

destroy:
	rm -Rf $(SRCDIR) $(TESTDIR) $(PHPUNITCONFIG) LICENSE stub.php

test:
	`which phpunit` --configuration $(PHPUNITCONFIG)

build:
	if [ ! -e "$(PHARBUILD)" ]; then \
		echo "You need to install koto/phar-util pear package to proceed"; \
		echo "If you have already installed it, set path to phar-build executable in PHARBUILD variable when running 'make build'"; \
		echo "You can install it by running"; \
		echo "pear channel-discover pear.kotowicz.net && pear install kotowicz/PharUtil-beta"; \
		exit 1; \
	fi;
	echo "$$stub" >> stub.php
	phar-build -s ./$(SRCDIR)/$(PROJECT) -S ./stub.php --phar ./$(BUILDFILE) --ns
	rm -f stub.php
