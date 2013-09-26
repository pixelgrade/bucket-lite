Run +phpunit or +behat to run the tool tests or behavior tests.

The scripts will automatically pull in any dependencies. You may adjust which
tools/versions are pulled in via the composer.json file. If the system detects
you din't perform an install it will perform one for you; you may need to
re-run the tool after the install is done.

Use +cleanup if you need to remove all the tooling for the purpose of
performing some theme-check via a 3rd party plugin. There's no need to worry
about download times, the composer dependencies, which are the bulk of the
testing toolset will automatically be cached so you will only need to
re-download if you're retrieving an updated version.

Debugging Tests
===============

	Netbeans Debug Options
	---------------------------------------------------------------------------
		Run as: Script
	Index File: wpgrade-core/checks/vendor/phpunit/phpunit/phpunit.php
	 Arguments: --bootstrap wpgrade-core/tests/bootstrap.php --coverage-html wpgrade-core/checks/reports/code-coverage wpgrade-core
	 Directory: (select the theme directory)