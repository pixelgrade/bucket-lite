#!/usr/bin/env ruby

# change to script
Dir.chdir File.expand_path(File.dirname(__FILE__))

# check if dependencies need to be installed
if ! File.exists?('bin/phpunit')
	Kernel.exec('sh tools/composer-install');
end

# execute phpunit
# we have to do it though another script due to parameter passing
Dir.chdir File.expand_path(File.dirname(__FILE__)+'/..')
Kernel.exec('sh wpgrade-checks/tools/phpunit-executor');
